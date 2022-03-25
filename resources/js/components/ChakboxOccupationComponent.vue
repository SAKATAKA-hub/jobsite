<template>
    <div>


        <div class="d-flex align-items-center mb-3 " v-if="occupation.group01s.length" >

            <!-- チェックボックス -->
            <input class="form-check-input fs-5 m-0" type="checkbox"
             id="occupation_input_all"
            >

            <!-- ラベル -->
            <label class="form-check-label" for="occupation_input_all">
                <h5 class="m-0 ms-1">全ての職種</h5>
            </label>
        </div>


        <!-- グループ01 -->
        <ul class="list-group">
            <li class="list-group-item bg-light" v-for=" group01 in occupation. group01s" :key=" group01.id">

                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <!-- チェックボックス -->
                        <input class="form-check-input fs-5 m-0" type="checkbox" v-model=" group01.cheked"
                         :id=" 'occupation_input'+  group01.id "
                        >

                        <!-- ラベル -->
                        <label class="form-check-label" :for=" 'occupation_input'+  group01.id ">
                            <h5 class="m-0 ms-1">{{  group01.name }}</h5>
                        </label>
                    </div>

                    <button class="btn btn-secondary" type="button"
                     data-bs-toggle="collapse" :data-bs-target=" '#occupation_itembox'+  group01.id "
                     aria-expanded="false" :aria-controls=" 'occupation_itembox'+  group01.id "
                    >open</button>
                </div>




                <!-- グループ02 -->
                <div class="collapse" :id=" 'occupation_itembox'+ group01.id ">
                    <ul class="list-group m-3">
                        <li class="list-group-item bg-light bg-white" v-for="group02 in group01.rel_group02s" :key="group02.id">
                            <div class="d-flex justify-content-between">

                                <div class="d-flex align-items-center">
                                    <!-- チェックボックス -->
                                    <input class="form-check-input fs-5 m-0" type="checkbox" v-model="group02.cheked"
                                     :id=" 'group02_input'+ group02.id "
                                    >

                                    <!-- ラベル -->
                                    <label class="form-check-label" :for=" 'group02_input'+ group02.id ">
                                        <h6 class="m-0 ms-1"> {{ group02.name }}</h6>
                                    </label>
                                </div>

                                <button class="btn btn-secondary" type="button"
                                data-bs-toggle="collapse" :data-bs-target=" '#group02_itembox'+ group02.id "
                                aria-expanded="false" :aria-controls=" 'group02_itembox'+ group02.id "
                                >open</button>
                            </div>



                            <!-- アイテム -->
                            <div class="collapse" :id=" 'group02_itembox'+ group02.id ">
                                <ul class="list-group m-3">
                                    <li class="list-group-item bg-light bg-white" v-for="item in group02.rel_items" :key="item.id">
                                        <div class="d-flex justify-content-between">

                                            <div class="d-flex align-items-center">
                                                <!-- チェックボックス -->
                                                <input class="form-check-input fs-5 m-0" type="checkbox"  v-model="item.cheked"
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
                </div>
                <!-- end グループ02 -->


            </li>
        </ul>
        <!-- end グループ01 -->


    </div>
</template>


<script>
    export default {
        data: function() {
            return {
                csrf_token: document.querySelector('meta[name="csrf-token"]').content,
                route: {
                    wc_occupation_api: document.querySelector('meta[name="wc_occupation_api"]').content,
                },

                occupation: {
                    cheked: false,
                    group01s: [],
                }
            }
        },
        mounted() {
            // console.log(this.route.wc_occupation_api);

            fetch( this.route.wc_occupation_api)
            .then(response => {
                if(!response.ok){ throw new Error(); }
                return response.json();
            })
            .then(json => {
                // JSONをdataにコピー
                // console.log(json);
                this.occupation.group01s = json.occupation_group01s;
                console.log(this.occupation.group01s);
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
