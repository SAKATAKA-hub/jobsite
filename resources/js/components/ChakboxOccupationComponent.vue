<template>
    <div>


        <div class="d-flex align-items-center mb-3 " v-if="occupation.group01s.length" >

            <!-- チェックボックス -->
            <input class="form-check-input fs-5 m-0" type="checkbox" v-model="occupation.cheked"
             id="occupation_input_all"
             @change="changeCheckBox(occupation,'occupation')"
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
                         @change="changeCheckBox(group01,'group01')"
                        >

                        <!-- ラベル -->
                        <label class="form-check-label" :for=" 'occupation_input'+  group01.id ">
                            <h5 class="m-0 ms-1">{{ group01.name }}</h5>
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
                                     :id=" 'occupation_group02_input'+ group02.id "
                                     @change="changeCheckBox(group02,'group02')"
                                    >

                                    <!-- ラベル -->
                                    <label class="form-check-label" :for=" 'occupation_group02_input'+ group02.id ">
                                        <h6 class="m-0 ms-1"> {{ group02.name }}</h6>
                                    </label>
                                </div>

                                <button class="btn btn-secondary" type="button"
                                data-bs-toggle="collapse" :data-bs-target=" '#occupation_group02_itembox'+ group02.id "
                                aria-expanded="false" :aria-controls=" 'occupation_group02_itembox'+ group02.id "
                                >open</button>
                            </div>



                            <!-- アイテム -->
                            <div class="collapse" :id=" 'occupation_group02_itembox'+ group02.id ">
                                <ul class="list-group m-3">
                                    <li class="list-group-item bg-light bg-white" v-for="item in group02.rel_items" :key="item.id">
                                        <div class="d-flex justify-content-between">

                                            <div class="d-flex align-items-center">
                                                <!-- チェックボックス -->
                                                <input class="form-check-input fs-5 m-0" type="checkbox"  v-model="item.cheked"
                                                 :id=" 'occupation_item_input'+ item.id "
                                                 @change="changeCheckBox(item,'item')"
                                                >

                                                <!-- ラベル -->
                                                <label class="form-check-label" :for=" 'occupation_item_input'+ item.id ">
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
                // console.log(this.occupation.group01s);
            })
            .catch(error => {
                alert('データの読み込みに失敗しました。');
            });
        },
        methods: {



            /**
             *
             *
            */
            changeCheckBox: function(object, ob_name){


                /* A-0 occupationの子データのチェックを変更する関数 */
                const changOccupationChildrenCheked = function(object){

                    // 子データグループ名
                    const children_name = 'group01s';
                    console.log(object[children_name]);
                    console.log(object);

                    // 子データのチェックを変更
                    for (let index = 0; index < object[children_name].length; index++) {
                        const child = object[children_name][index];

                        child.cheked = object.cheked;

                        // 子孫データのチェックを変更
                        changeGroup01ChildrenCheked(child);
                    }
                }


                /* A-1 group01の子データのチェックを変更する関数 */
                const changeGroup01ChildrenCheked = function(object){

                    // 子データグループ名
                    const children_name = 'rel_group02s';

                    // 子データのチェックを変更
                    for (let index = 0; index < object[children_name].length; index++) {
                        const child = object[children_name][index];

                        child.cheked = object.cheked;

                        // 子孫データのチェックを変更
                        changeGroup02ChildrenCheked(child);
                    }
                }


                /* A-2 group02の子データのチェックを変更する関数 */
                // object : チェックされたオブジェクト
                const changeGroup02ChildrenCheked = function(object){

                    // 子データグループ名
                    const children_name = 'rel_items';

                    // 子データのチェックを変更
                    for (let index = 0; index < object[children_name].length; index++) {
                        const child = object[children_name][index];

                        child.cheked = object.cheked;
                    }

                    // 子孫データのチェックを変更
                }


                /* B-1 group01の親データのチェックを変更する関数 */
                // parent : 親オブジェクト
                const changeGroup01PalentCheked = function(occupation){

                    let parent_cheked = true;
                    for (let index = 0; index < occupation['group01s'].length; index++) {
                        const group01 = occupation['group01s'][index];

                        parent_cheked = ! group01.cheked ? false : parent_cheked ;
                    }
                    occupation.cheked = parent_cheked;

                }


                const changeGroup02PalentCheked = function(occupation){
                    console.log(parent);

                    for (let index = 0; index < occupation['group01s'].length; index++) {
                        const group01 = occupation['group01s'][index];

                        let parent_cheked = true;
                        for (let index = 0; index < group01['rel_group02s'].length; index++) {
                            const group02 =  group01['rel_group02s'][index];

                            parent_cheked = ! group02.cheked ? false : parent_cheked ;
                        }
                        group01.cheked = parent_cheked;

                    }

                    // 先祖データのチェックを変更
                }

                switch (ob_name) {
                    case 'occupation':
                        changOccupationChildrenCheked(object);
                        break;
                    //
                    case 'group01':
                        changeGroup01ChildrenCheked(object);
                        changeGroup01PalentCheked(this.occupation);
                        break;
                    //
                    case 'group02':
                        changeGroup02ChildrenCheked(object);
                        // changeGroup02PalentCheked(this.occupation);
                        break;
                    //
                    case 'item':

                        break;
                    //
                    default:
                        break;
                }



            },
        },
    }
</script>
