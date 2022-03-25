<template>
    <div>


        <div class="d-flex align-items-center mb-3" v-if="other.groups.length">

            <!-- チェックボックス -->
            <input class="form-check-input fs-5 m-0" type="checkbox"
             id="other_input_all"
            >

            <!-- ラベル -->
            <label class="form-check-label" for="other_input_all">
                <h5 class="m-0 ms-1">全ての職種</h5>
            </label>
        </div>


        <!-- グループ -->
        <ul class="list-group">
            <li class="list-group-item bg-light" v-for=" group in other. groups" :key=" group.id">

                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <!-- チェックボックス -->
                        <input class="form-check-input fs-5 m-0" type="checkbox" v-model=" group.cheked"
                         :id=" 'other_input'+  group.id "
                        >

                        <!-- ラベル -->
                        <label class="form-check-label" :for=" 'other_input'+  group.id ">
                            <h5 class="m-0 ms-1">{{  group.name }}</h5>
                        </label>
                    </div>

                    <button class="btn btn-secondary" type="button"
                     data-bs-toggle="collapse" :data-bs-target=" '#other_itembox'+  group.id "
                     aria-expanded="false" :aria-controls=" 'other_itembox'+  group.id "
                    >open</button>
                </div>


                <!-- アイテム -->
                <div class="collapse" :id=" 'other_itembox'+ group.id ">
                    <ul class="list-group m-3">
                        <li class="list-group-item bg-light bg-white" v-for="item in group.rel_items" :key="item.id">
                            <div class="d-flex justify-content-between">

                                <div class="d-flex align-items-center">
                                    <!-- チェックボックス -->
                                    <input class="form-check-input fs-5 m-0" type="checkbox" v-model="item.cheked"
                                     :id=" 'item_input'+ item.id "
                                    >

                                    <!-- ラベル -->
                                    <label class="form-check-label" :for=" 'item_input'+ item.id ">
                                        <h6 class="m-0 ms-1"> {{ item.name }}</h6>
                                    </label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- end アイテム -->


            </li>
        </ul>
        <!-- end グループ -->


    </div>
</template>


<script>
    export default {
        data: function() {
            return {
                csrf_token: document.querySelector('meta[name="csrf-token"]').content,
                route: {
                    wc_other_api: document.querySelector('meta[name="wc_other_api"]').content,
                },

                other: {
                    cheked: false,
                    groups: [],
                }
            }
        },
        mounted() {
            fetch( this.route.wc_other_api)
            .then(response => {
                if(!response.ok){ throw new Error(); }
                return response.json();
            })
            .then(json => {
                // JSONをdataにコピー
                console.log(json);
                this.other.groups = json.other_groups;
                 console.log(this.other.groups);
            })
            .catch(error => {
                alert('データの読み込みに失敗しました。');
            });
        },
        methods: {
            //
        },
    }
</script>
