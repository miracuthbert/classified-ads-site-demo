<template>
    <form action="#" class="form" autocomplete="off">
        <div class="input-group">
            <input type="text" class="form-control"
                   placeholder="Search listings by title, details, location, category, etc..." id="listing-search"/>
            <span class="input-group-btn">
                <button class="btn btn-primary" id="btnListingSearch">
                    Search
                </button>
            </span>
        </div>
    </form>
</template>

<script>
    import { listingsautocomplete } from '../../helpers/autocomplete.js'

    export default {
        props: [
            'categoryId',
            'areaIds',
        ],
        mounted() {

            listingsautocomplete('#listing-search', {
                categoryId: this.categoryId,
                areaIds: this.areaIds,
            })

        }
    }
</script>