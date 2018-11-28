<div class="col col-12 col-sm-12 col-md-6 col-xl-5 stats-col">
    <div class="card sameheight-item stats" data-exclude="xs">
        <div class="card-block">
            <div class="title-block">
                <h4 class="title"> Stats </h4>
                <p class="title-description"> Website metrics for <a
                            href="{{ route('home') }}">{{ config('app.name') }}</a></p>
            </div>
            <div class="row row-sm stats-container">
                <div class="col-12 col-sm-6 stat-col">
                    <div class="stat-icon"><i class="fa fa-rocket"></i></div>
                    <div class="stat">
                        <div class="value"> {{ $total_listings }} </div>
                        <div class="name"> Listings</div>
                    </div>
                    <progress class="progress stat-progress" value="75" max="100">
                        <div class="progress">
                            <span class="progress-bar" style="width: 75%;"></span>
                        </div>
                    </progress>
                </div>
                <div class="col-12 col-sm-6 stat-col">
                    <div class="stat-icon"><i class="fa fa-shopping-cart"></i></div>
                    <div class="stat">
                        <div class="value"> {{ $total_live_listings }}
                            ({{ $total_listings > 0 ? number_format(($total_live_listings / $total_listings) * 100, 2) : 0 }}%)
                        </div>
                        <div class="name"> Live listings</div>
                    </div>
                    <progress class="progress stat-progress"
                              value="{{ $total_listings > 0 ? number_format(($total_live_listings / $total_listings) * 100, 2) : 0 }}" max="100">
                        <div class="progress">
                            <span class="progress-bar"
                                  style="width: {{ $total_listings > 0 ? number_format(($total_live_listings / $total_listings) * 100, 2) : 0 }}%;"></span>
                        </div>
                    </progress>
                </div>
                <div class="col-12 col-sm-6  stat-col">
                    <div class="stat-icon"><i class="fa fa-users"></i></div>
                    <div class="stat">
                        <div class="value"> {{ $total_users }} </div>
                        <div class="name"> Total users</div>
                    </div>
                    <progress class="progress stat-progress" value="34" max="100">
                        <div class="progress">
                            <span class="progress-bar" style="width: 34%;"></span>
                        </div>
                    </progress>
                </div>
                <div class="col-12 col-sm-6  stat-col">
                    <div class="stat-icon"><i class="fa fa-users"></i></div>
                    <div class="stat">
                        <div class="value"> {{ $users_with_listings }}
                            ({{ $total_users > 0 ? number_format(($users_with_listings / $total_users) * 100, 2) : 0 }}%)
                        </div>
                        <div class="name"> Users + (listings)</div>
                    </div>
                    <progress class="progress stat-progress"
                              value="({{ $total_users > 0 ? number_format(($users_with_listings / $total_users) * 100, 2) : 0 }}%)" max="100">
                        <div class="progress">
                            <span class="progress-bar"
                                  style="width: {{ $total_users > 0 ? number_format(($users_with_listings / $total_users) * 100, 2) : 0 }}%;"></span>
                        </div>
                    </progress>
                </div>
                <div class="col-12 col-sm-6  stat-col">
                    <div class="stat-icon"><i class="fa fa-users"></i></div>
                    <div class="stat">
                        <div class="value"> {{ $users_with_live_listings }}
                            ({{ $total_users > 0 ? number_format(($users_with_live_listings / $total_users) * 100, 2) : 0 }}%)
                        </div>
                        <div class="name"> Users + (live listings)</div>
                    </div>
                    <progress class="progress stat-progress"
                              value="({{ $total_users > 0 ? number_format(($users_with_live_listings / $total_users) * 100, 2) : 0 }}%)" max="100">
                        <div class="progress">
                            <span class="progress-bar"
                                  style="width: {{ $total_users > 0 ? number_format(($users_with_live_listings / $total_users) * 100, 2) : 0 }}%;"></span>
                        </div>
                    </progress>
                </div>
                <div class="col-12 col-sm-6 stat-col">
                    <div class="stat-icon"><i class="fa fa-shopping-cart"></i></div>
                    <div class="stat">
                        <div class="value"> 80000</div>
                        <div class="name"> Free listings</div>
                    </div>
                    <progress class="progress stat-progress" value="25" max="100">
                        <div class="progress">
                            <span class="progress-bar" style="width: 25%;"></span>
                        </div>
                    </progress>
                </div>
                <div class="col-12 col-sm-6 stat-col">
                    <div class="stat-icon"><i class="fa fa-shopping-cart"></i></div>
                    <div class="stat">
                        <div class="value"> 78464</div>
                        <div class="name"> Listings sold</div>
                    </div>
                    <progress class="progress stat-progress" value="25" max="100">
                        <div class="progress">
                            <span class="progress-bar" style="width: 25%;"></span>
                        </div>
                    </progress>
                </div>
                <div class="col-12 col-sm-6  stat-col">
                    <div class="stat-icon"><i class="fa fa-line-chart"></i></div>
                    <div class="stat">
                        <div class="value"> $80.560</div>
                        <div class="name"> Monthly income</div>
                    </div>
                    <progress class="progress stat-progress" value="60" max="100">
                        <div class="progress">
                            <span class="progress-bar" style="width: 60%;"></span>
                        </div>
                    </progress>
                </div>
                <div class="col-12 col-sm-6 stat-col">
                    <div class="stat-icon"><i class="fa fa-dollar"></i></div>
                    <div class="stat">
                        <div class="value"> $780.064</div>
                        <div class="name"> Total income</div>
                    </div>
                    <progress class="progress stat-progress" value="15" max="100">
                        <div class="progress">
                            <span class="progress-bar" style="width: 15%;"></span>
                        </div>
                    </progress>
                </div>
                <div class="col-12 col-sm-6  stat-col">
                    <div class="stat-icon"><i class="fa fa-list-alt"></i></div>
                    <div class="stat">
                        <div class="value"> 59</div>
                        <div class="name"> Tickets closed</div>
                    </div>
                    <progress class="progress stat-progress" value="49" max="100">
                        <div class="progress">
                            <span class="progress-bar" style="width: 49%;"></span>
                        </div>
                    </progress>
                </div>
            </div>
        </div>
    </div>
</div>