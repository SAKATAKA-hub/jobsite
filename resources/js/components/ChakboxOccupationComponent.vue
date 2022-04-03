<template>
    <div>
        <button class="mb-3" @click="confirmInput()">確定</button>



        <div class="d-flex align-items-center mb-3 " v-if="occupation.group01s.length" >
            <!-- チェックボックス -->
            <input class="form-check-input fs-5 m-0" type="checkbox" v-model="occupation.checked"
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
                        <input class="form-check-input fs-5 m-0" type="checkbox" v-model=" group01.checked"
                         :id=" 'occupation_input'+  group01.id "
                         @change="changeCheckBox(group01,'group01')"
                        >

                        <!-- ラベル -->
                        <label class="form-check-label" :for=" 'occupation_input'+  group01.id ">
                            <h5 class="m-0 ms-1">{{ group01.name }}</h5>
                        </label>

                        <!-- バッジ -->
                        <span class="ms-1 badge bg-success" v-if="group01.checked_children">
                            選択中
                        </span>
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
                                    <input class="form-check-input fs-5 m-0" type="checkbox" v-model="group02.checked"
                                     :id=" 'occupation_group02_input'+ group02.id "
                                     @change="changeCheckBox(group02,'group02')"
                                    >

                                    <!-- ラベル -->
                                    <label class="form-check-label" :for=" 'occupation_group02_input'+ group02.id ">
                                        <h6 class="m-0 ms-1"> {{ group02.name }}</h6>
                                    </label>

                                    <!-- バッジ -->
                                    <span class="ms-1 badge bg-success" v-if="group02.checked_children">
                                        選択中
                                    </span>
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
                                                <input class="form-check-input fs-5 m-0" type="checkbox"  v-model="item.checked"
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
                    checked: false,
                    group01s: [],
                },

                inputs: {
                    group01s:[],
                    group02s: [],
                    items: [],
                },

            }


        },
        mounted() {

            fetch( this.route.wc_occupation_api)
            .then(response => {
                if(!response.ok){ throw new Error(); }
                return response.json();
            })
            .then(json => {
                // JSONをdataにコピー
                // console.log(json);
                this.occupation.group01s = json.occupation_group01s;

                //オブジェクトに要素の追加(parent)
                this.addObjectElement();
                // console.log(this.occupation);
            })
            .catch(error => {
                alert('データの読み込みに失敗しました。');
            });



        },
        methods: {


            /**
             * チェックボックスクリック時に実行されるメソッド
             *
             * @param Object object
             * @param String ob_name
            */
            changeCheckBox: function(object, ob_name){



                /* A-0(親->子) occupationの子データのチェックを変更する関数 */
                const changOccupationChildrenChecked = function(object){

                    // 子データグループ名
                    const children_name = 'group01s';

                    // 子データのチェックを変更
                    for (let index = 0; index < object[children_name].length; index++) {
                        const child = object[children_name][index];

                        child.checked = object.checked;

                        // 子孫データのチェックを変更
                        changeGroup01ChildrenChecked(child);
                    }

                    //チェックが入っている子供がいるかどうか(なし)
                }


                /* A-1(親->子) group01の子データのチェックを変更する関数 */
                const changeGroup01ChildrenChecked = function(object){

                    // 子データグループ名
                    const children_name = 'rel_group02s';

                    // 子データのチェックを変更
                    for (let index = 0; index < object[children_name].length; index++) {
                        const child = object[children_name][index];

                        child.checked = object.checked;

                        // 子孫データのチェックを変更
                        changeGroup02ChildrenChecked(child);
                    }

                    //チェックが入っている子供がいるかどうか
                    object.checked_children = object.checked;
                }


                /* A-2(親->子) group02の子データのチェックを変更する関数 */
                // object : チェックされたオブジェクト
                const changeGroup02ChildrenChecked = function(object){

                    // 子データグループ名
                    const children_name = 'rel_items';

                    // 子データのチェックを変更
                    for (let index = 0; index < object[children_name].length; index++) {
                        const child = object[children_name][index];

                        child.checked = object.checked;

                        // 子孫データのチェックを変更(なし)
                    }

                    //チェックが入っている子供がいるかどうか
                    object.checked_children = object.checked;
                }




                /* B-1(子->親) group01の親データのチェックを変更する関数 */
                // object : チェックされたオブジェクト
                const changeGroup01PalentChecked = function(object){
                    const parent = object.parent;
                    const children = parent['group01s'];

                    parent.checked = true; //親のチェック
                    // parent.checked_children = false; //チェックが入っている子供がいるかどうか(なし)
                    for (let index = 0; index < children.length; index++) {
                        const child = children[index];

                        parent.checked = ! child.checked ? false : parent.checked ;
                        // parent.checked_children = child.checked_children ? true : parent.checked_children;
                    }

                    // 先祖データのチェックを変更(なし)
                }


                /* B-2(子->親) group02の親データのチェックを変更する関数 */
                // object : チェックされたオブジェクト
                const changeGroup02PalentChecked = function(object){
                    const parent = object.parent;
                    const children = parent['rel_group02s'];

                    parent.checked = true; //親のチェック
                    parent.checked_children = false; //チェックが入っている子供がいるかどうか
                    for (let index = 0; index < children.length; index++) {
                        const child = children[index];

                        parent.checked = ! child.checked ? false : parent.checked ;
                        parent.checked_children = child.checked ? true : ( child.checked_children ? true : parent.checked_children );
                    }

                    // 先祖データのチェックを変更
                    changeGroup01PalentChecked(parent);
                }


                /* B-3(子->親) itemの親データのチェックを変更する関数 */
                // object : チェックされたオブジェクト
                const changeItemPalentChecked = function(object){
                    const parent = object.parent;
                    const children = parent['rel_items'];

                    parent.checked = true; //親のチェック
                    parent.checked_children = false; //チェックが入っている子供がいるかどうか
                    for (let index = 0; index < children.length; index++) {
                        const child = children[index];

                        parent.checked = ! child.checked ? false : parent.checked ;
                        parent.checked_children = child.checked ? true : parent.checked_children;
                    }
                    // console.log(parent.checked_children);

                    // 先祖データのチェックを変更
                    changeGroup02PalentChecked(parent);
                }




                /* 分岐処理 */
                switch (ob_name) {
                    case 'occupation':
                        changOccupationChildrenChecked(object);//(親->子)
                        break;
                    //
                    case 'group01':
                        changeGroup01ChildrenChecked(object);//(親->子)
                        changeGroup01PalentChecked(object);//(子->親)
                        break;
                    //
                    case 'group02':
                        changeGroup02ChildrenChecked(object);//(親->子)
                        changeGroup02PalentChecked(object);//(子->親)
                        break;
                    //
                    case 'item':
                        changeItemPalentChecked(object);//(子->親)
                        break;
                    //
                    default:
                        break;
                    //
                }


            }, //end changeCheckBox


            /**
             * 読込みオブジェクトに要素の追加(mountedで利用)
             *
             * parent 親オブジェクト参照要素の追加
            */
            addObjectElement: function(){

                /* group01 */
                const group01s = this.occupation.group01s;
                for (let g1_i = 0; g1_i <  group01s.length; g1_i++) {
                    const group01 =  group01s[g1_i];

                    // 親オブジェクト参照要素の追加
                    group01['parent'] = this.occupation;


                    /* group02s */
                    const group02s = group01.rel_group02s;
                    for (let g2_i = 0; g2_i < group02s.length; g2_i++) {
                        const group02 = group02s[g2_i];

                        // 親オブジェクト参照要素の追加
                        group02['parent'] = group01;


                        /* items */
                        const items = group02.rel_items;
                        for (let itm_i = 0; itm_i < items.length; itm_i++) {
                            const item = items[itm_i];

                            // 親オブジェクト参照要素の追加
                            item['parent'] = group02;
                        }
                    }
                }

                // console.log(this.occupation.group01s[0].rel_group02s[0].rel_items[0]);
            },//end addObjectElement


            /**
             * 入力内容を元に戻す
             *
            */
            returnInput: function(){},

            /**
             * 入力内容を確定する()
             *
            */
            confirmInput: function(){

                // inputsのリセット
                this.inputs = { group01s:[], group02s: [], items: [], };


                /* group01 */
                const group01s = this.occupation.group01s;
                for (let g1_i = 0; g1_i <  group01s.length; g1_i++) {
                    const group01 =  group01s[g1_i];

                    // inputsに追加
                    if( group01.checked ){
                        this.inputs['group01s'].push(group01.name);
                        continue;
                    }


                    /* group02s */
                    const group02s = group01.rel_group02s;
                    for (let g2_i = 0; g2_i < group02s.length; g2_i++) {
                        const group02 = group02s[g2_i];

                        // inputsに追加
                        if( group02.checked ){
                            this.inputs['group02s'].push(group02.name);
                            continue;
                        }



                        /* items */
                        const items = group02.rel_items;
                        for (let itm_i = 0; itm_i < items.length; itm_i++) {
                            const item = items[itm_i];

                            // inputsに追加
                            if( item.checked ){
                                this.inputs['items'].push(item.name);
                                continue;
                            }

                        }
                    }
                }


                // 選択内容表示用テキスト
                // const n = 15; //テキストの最大表示文字数

                const array = [...this.inputs.group01s, ...this.inputs.group02s, ...this.inputs.items];
                let text = array.join(' / ');
                // text = text.length > n ? text.substring(0,n-1) + ' ・・・' : text;

                console.log(text);
                console.log(this.inputs);
            },//end confirmInput

        },
    }
</script>
