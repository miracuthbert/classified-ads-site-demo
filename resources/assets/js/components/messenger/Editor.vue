<template>
    <form action="" class="form-horizontal">
        <input type="hidden" name="recipient" v-model="recipientId">
        <!--<input type="hidden" name="recipientIndex" v-model="createIndex">-->
        <input type="hidden" name="subject" v-model="messageSubject">
        <input type="hidden" name="req_method" v-model="requestMethod">
        <!--Uncomment lines below to after adding file upload functionality-->
        <!--
                        <div class="row">
                            <div class="col-sm-8">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation">
                                        <a href="#tabfile" aria-controls="file" role="tab" data-toggle="tab"
                                           title="Attach a file">
                                            <i class="fa fa-paperclip"></i> Attach file
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#tabphoto" aria-controls="photo" role="tab" data-toggle="tab"
                                           title="Add a photo">
                                            <i class="fa fa-photo"></i> Upload photo
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#tabaudio" aria-controls="audio" role="tab" data-toggle="tab"
                                           title="Record an audio">
                                            <i class="fa fa-microphone"></i> Record audio
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane" id="tabfile">
                                        <div class="form-group input-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default">Browse</button>
                                    </span>
                                            <input type="file" name="file" class="form-control" id="file">
                                            <span class="input-group-btn">
                                        <button class="btn btn-primary">Upload</button>
                                    </span>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="tabphoto">
                                        <div class="form-group input-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default">Browse</button>
                                    </span>
                                            <input type="file" name="file" class="form-control" id="photo">
                                            <span class="input-group-btn">
                                        <button class="btn btn-primary">Upload</button>
                                    </span>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="tabaudio">
                                        <div class="form-group input-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default">Browse</button>
                                    </span>
                                            <input type="file" name="file" class="form-control" id="audio">
                                            <span class="input-group-btn">
                                        <button class="btn btn-primary">Upload</button>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        -->
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group" :class="messageBodyAlert">
                            <textarea id="conversation-message" class="form-control"
                                      placeholder="Type your message here..." maxlength="160" v-model="messageBody"
                                      @keydown="handleMessageInput" ref="messageEditor"></textarea>
                    <div class="text-right text-muted">
                        {{ characterCount }} / <strong>160</strong> ({{ wordCount }} words)
                    </div>
                    <span class="help-block"><strong>{{ messageError }}</strong></span>
                    <span class="help-block">Type your message and press enter to send</span>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import Bus from '../../bus'
    import moment from 'moment'

    export default {
        data() {
            return {
                thread: null,
                recipient: null,
                creator: null,
                recipientId: null,
                requestMethod: null,
                messageBody: null,
                messageBodyBackUp: null,
                messageError: null,
                messageBodyAlert: null,
                messageSubject: null,
                backedUpMessageSubject: null,
            }
        },
        methods: {
            handleMessageInput(e) {

                //store message data
                this.messageBodyBackUp = this.messageBody;
                this.backedUpMessageSubject = this.messageSubject;

                this.messageBodyAlert = null;
                this.messageError = null;

                if (e.keyCode === 13 && !e.shiftKey) {
                    e.preventDefault();

                    this.sendMessage();
                }
            },
            buildTempMessage() {

                let tempId = Date.now();

                return {
                    id: tempId,
                    body: this.messageBody,
                    created_at: moment().format('YYYY-MM-DD HH:mm:ss'),
                    selfOwned: true,
                    user: {
                        id: Laravel.user.id,
                        name: Laravel.user.name,
                        username: Laravel.user.username,
                    }
                }
            },
            setRequestMethod(method) {
                this.requestMethod = method;
            },
            setResponseThread(thread) {
                this.thread = thread;
            },
            getMessageBackup() {
                return this.messageBodyBackUp;
            },
            sendMessage() {
                if (!this.recipientId || this.recipientId <= 0) {
                    this.messageBodyAlert = "has-error";
                    this.messageError = "Start a new conversation or select an existing one";

                    return;
                }
                //check if message body is empty
                else if (!this.messageBody || this.messageBody.trim() === '') {
                    this.messageBodyAlert = "has-error";
                    this.messageError = "Message is required";

                    return;
                }

                //temp message
                let tempMessage = this.buildTempMessage();

                //update the ui
                Bus.$emit('messages.added', tempMessage);

                //send req to backend
                if (this.requestMethod == "PUT") {
                    axios.put('/messenger/messages/' + this.thread.id, {
                        body: this.messageBody.trim(),
                        recipient: this.recipientId
                    }).then(function (response) {

                        //handle response here

                    }).catch(function (error) {
                        console.log(error)
                        console.log(this.messageBodyBackUp)

                        //revert
                        this.messageBody = this.messageBodyBackUp;

                        this.messageBodyAlert = "has-error";
                        this.messageError = "Failed sending message!";

                        Bus.$emit('messages.remove', tempMessage);
                    })
                } else {
                    axios.post('/messenger/messages', {
                        body: this.messageBody.trim(),
                        subject: this.messageSubject.trim(),
                        recipient: this.recipientId
                    }).then(function (response) {

                        //remove recipient
                        Bus.$emit('recipients.remove', response.data.data.recipient.data);

                        //add thread
                        Bus.$emit('thread.added', response.data.data);

                    }).catch(function (error) {

                        //remove message
                        Bus.$emit('messages.remove', tempMessage);
                    });

                }

                this.messageBody = null;
            }
        },
        mounted() {
            Bus.$on('conversation.create', (recipient) => {
                this.requestMethod = "POST";

                this.recipient = recipient;

                this.recipientId = recipient.id;
                this.recipientName = recipient.name;

                this.messageBody = "Hi " + this.recipientName;
                this.messageSubject = "Conversation with " + this.recipientName;
                this.$refs.messageEditor.focus(true);

            }).$on('conversation.show', (thread) => {
                this.requestMethod = "PUT";

                this.thread = thread;
                this.recipient = thread.recipient.data;
                this.creator = thread.creator.data;

                this.recipientId = this.creator.id === Laravel.user.id ? this.recipient.id : this.creator.id;
                this.messageSubject = this.thread.subject;
                this.recipientName = this.recipient.name;

            }).$on('thread.added', (thread) => {

                //set request method to PUT after POST
                this.setRequestMethod("PUT");

                //set thread to response thread
                this.setResponseThread(thread);

            }).$on('messages.remove', (message) => {
                //revert
                this.messageBody = this.getMessageBackup();

                this.messageBodyAlert = "has-error";
                this.messageError = "Failed sending message!";
            });

        },
        computed: {
            characterCount() {
                if (!this.messageBody || this.messageBody.trim() === '') {
                    return 0;
                }

                return this.messageBody.trim().length
            },
            wordCount() {
                if (!this.messageBody || this.messageBody.trim() === '') {
                    return 0;
                }

                return this.messageBody.trim().split(' ').length
            }
        },
    }
</script>
