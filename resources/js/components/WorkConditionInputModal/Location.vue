<template>
    <div>

        <div class="d-flex justify-content-between align-items-center"
          data-bs-toggle="modal" data-bs-target="#wcLocationModal"
          @click="startInput()"
          style="cursor:pointer;"
        >

            <div class="d-flex justify-content-between align-items-center">
                <h5 class="m-0 me-3">
                    <i class="bi bi-geo-alt-fill text-secondary me-1"></i>
                    {{ condition_name }}
                </h5>

                <div class="text-secondary">{{ inputs_text }}</div>
            </div>

            <i class="bi bi-chevron-right text-primary"></i>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="wcLocationModal" tabindex="-1" aria-labelledby="wcLocationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="wcLocationModalLabel">
                            <i class="bi bi-geo-alt-fill text-secondary me-1"></i>{{ condition_name }}を選択
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <!-- modal-body -->
                    <div class="">

                        <div class="text-center text-secondary m-5" v-if="!location.radions.length">
                            読み込み中・・・
                        </div>

                        <!-- 地域 -->
                        <ul class="list-group list-group-flush" style>
                            <li class="list-group-item p-0"  v-for="radion in copy_location.radions" :key="radion.id">

                                <div class="p-2 ps-3 pe-3">
                                    <div class="d-flex justify-content-between">

                                        <h5 class="m-0 ms-1">{{ radion.name }}</h5>

                                        <a class="text-primary fw-bold" type="button"
                                        data-bs-toggle="collapse" :data-bs-target=" '#location_radion_itembox'+ radion.id "
                                        aria-expanded="false" :aria-controls=" 'location_radion_itembox'+ radion.id "
                                        ><i class="bi bi-chevron-down"></i></a>

                                    </div>
                                </div>


                                <!-- 都道府県 -->
                                <ul class="list-group list-group-flush  collapse" :id=" 'location_radion_itembox'+ radion.id ">
                                    <li class="list-group-item p-0 ps-3">
                                        <div class="p-2 ps-0 pe-3">

                                            <!-- チェックボックス -->
                                            <input class="form-check-input mb-3" type="checkbox" v-model="radion.checked"
                                            :id=" 'location_radion_input'+ radion.id "
                                            @change="changeCheckBox(radion,'radion')"
                                            >

                                            <!-- ラベル(地域内すべて) -->
                                            <label class="form-check-label" :for=" 'location_radion_input'+ radion.id ">
                                                <div class="m-0 ms-1">{{ radion.name }}すべて</div>
                                            </label>

                                            <!-- バッジ -->
                                            <span class="ms-1 badge bg-success" v-if="radion.checked_children">
                                                選択中
                                            </span>

                                        </div>
                                    </li>
                                    <li class="list-group-item p-0 ps-3" v-for="todohuken in radion.todohukens" :key="todohuken.id">

                                        <div class="p-2 ps-3 pe-3">
                                            <div class="d-flex justify-content-between">

                                                <div>
                                                    <!-- チェックボックス -->
                                                    <input class="form-check-input mb-3" type="checkbox" v-model="todohuken.checked"
                                                    :id=" 'location_todohuken_input'+ todohuken.id "
                                                    @change="changeCheckBox(todohuken,'todohuken')"
                                                    >

                                                    <!-- ラベル(都道府県) -->
                                                    <label class="form-check-label" :for=" 'location_todohuken_input'+ todohuken.id ">
                                                        <div class="m-0 ms-1">{{ todohuken.name }}</div>
                                                    </label>

                                                    <!-- バッジ -->
                                                    <span class="ms-1 badge bg-success" v-if="todohuken.checked_children">
                                                        選択中
                                                    </span>
                                                </div>

                                                <a class="text-primary fw-bold" type="button"
                                                data-bs-toggle="collapse" :data-bs-target=" '#location_todohuken_itembox'+ todohuken.id "
                                                aria-expanded="false" :aria-controls=" 'location_todohuken_itembox'+ todohuken.id "
                                                ><i class="bi bi-chevron-down"></i></a>

                                            </div>
                                        </div>


                                        <!-- 市町村 -->
                                        <ul class="list-group list-group-flush  collapse" :id=" 'location_todohuken_itembox'+ todohuken.id ">
                                            <li class="list-group-item p-0 ps-3 border-0" v-for="shichoson in todohuken.shichosons" :key="shichoson.id">

                                                <div class="p-2 ps-3 pe-3">
                                                    <div class="d-flex justify-content-between">

                                                        <div>
                                                            <!-- チェックボックス -->
                                                            <input class="form-check-input mb-3" type="checkbox" v-model="shichoson.checked"
                                                            :id=" 'location_shichoson_input'+ shichoson.id "
                                                            @change="changeCheckBox(shichoson,'shichoson')"
                                                            >

                                                            <!-- ラベル(都道府県) -->
                                                            <label class="form-check-label" :for=" 'location_shichoson_input'+ shichoson.id ">
                                                                <div class="m-0 ms-1">{{ shichoson.name }}</div>
                                                            </label>

                                                            <!-- バッジ -->
                                                            <span class="ms-1 badge bg-success" v-if="shichoson.checked_children && shichoson.kus.length">
                                                                選択中
                                                            </span>
                                                        </div>

                                                        <a class="text-primary fw-bold" type="button"
                                                        v-if="shichoson.kus.length"
                                                        data-bs-toggle="collapse" :data-bs-target=" '#location_shichoson_itembox'+ shichoson.id "
                                                        aria-expanded="false" :aria-controls=" 'location_shichoson_itembox'+ shichoson.id "
                                                        ><i class="bi bi-chevron-down"></i></a>

                                                    </div>
                                                </div>


                                                <!-- 区 -->
                                                <div class="p-2 ps-3 pe-3  collapse" :id=" 'location_shichoson_itembox'+ shichoson.id " >
                                                    <div class="d-flex flex-wrap">
                                                        <div v-for="ku in shichoson.kus" :key="ku.id"
                                                        style="width:8rem;"
                                                        >
                                                            <!-- チェックボックス -->
                                                            <input class="form-check-input" type="checkbox" v-model="ku.checked"
                                                            :id=" 'location_ku_input' +ku.id "
                                                            @change="changeCheckBox(ku,'ku')"
                                                            >

                                                            <!-- ラベル -->
                                                            <label class="form-check-label" :for=" 'location_ku_input' +ku.id ">
                                                                {{ ku.name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                            </li>
                                        </ul>


                                    </li>
                                </ul>

                            </li>
                        </ul>
                    </div>
                    <!-- end modal-body -->


                    <div class="modal-footer">
                            <button class="btn btn-primary btn-long"  data-bs-dismiss="modal" aria-label="Close"
                             @click="confirmInput()"
                            >確定</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Modal -->


    </div>
</template>

<script>
    export default {
        data: function() {
            return {


                //text
                condition_name: '勤務地',
                inputs_text: '選択されていません',

                //meta data
                csrf_token: document.querySelector('meta[name="csrf-token"]').content,
                route: {
                    wc_location_api: document.querySelector('meta[name="wc_location_api"]').content,
                },

                //保存データ(location, radions, todohukens, shichosons, kus,)
                location: {
                    checked: false,
                    radions: [],
                },

                //コピーデータ(確定前)
                copy_location: [],

                //フォーム送信で送るデータ
                inputs: {
                    radions: [],
                    todohukens: [],
                    shichosons: [],
                    kus: [],
                },


            }
        },
        mounted() {

            fetch( this.route.wc_location_api)
            .then(response => {
                if(!response.ok){ throw new Error(); }
                return response.json();
            })
            .then(json => {
                // JSONをdataにコピー
                this.location.radions = json.location_radions; //保存データ
                this.addObjectElement(); //保存データオブジェクト内に要素の追加(parent)

                this.copy_location = Object.assign({}, this.location); //保存データのコピー

                // console.log(this.copy_location.radions);
            })
            .catch(error => {
                alert('データの読み込みに失敗しました。');
            });


        },
        methods: {


            /**
             * 存データオブジェクト内に要素の追加(mounted時に利用)
             *
             * parent 親オブジェクト参照要素の追加
            */
            addObjectElement: function(){
                // location, radions, todohukens, shichosons, kus,
                /* radions */
                const radions = this.location.radions;
                for (let rad_i = 0; rad_i <  radions.length; rad_i++) {
                    const radion =  radions[rad_i];

                    // 親オブジェクト参照要素の追加
                    radion['parent'] = this.location;


                    /* todohukens */
                    const todohukens = radion.todohukens;
                    for (let tod_i = 0; tod_i <  todohukens.length; tod_i++) {
                        const todohuken =  todohukens[tod_i];

                        // 親オブジェクト参照要素の追加
                        todohuken['parent'] = radion;


                        /* shichosons */
                        const shichosons = todohuken.shichosons;
                        for (let shi_i = 0; shi_i <  shichosons.length; shi_i++) {
                            const shichoson =  shichosons[shi_i];

                            // 親オブジェクト参照要素の追加
                            shichoson['parent'] = todohuken;


                            /* kus */
                            const kus = shichoson.kus;
                            for (let ku_i = 0; ku_i <  kus.length; ku_i++) {
                                const ku =  kus[ku_i];

                                // 親オブジェクト参照要素の追加
                                ku['parent'] = shichoson;
                            }
                        }
                    }
                }
            },//end addObjectElement


            /**
             * チェックボックスクリック時に実行されるメソッド
             *
             * @param Object object
             * @param String ob_name
            */
            changeCheckBox: function(object, ob_name){

                //保存データ(location, radions, todohukens, shichosons, kus,)


                /* A-0(親->子供) radionの子供データのチェックを変更する関数 */
                const changRadionChildrenChecked = (object)=>{
                    // 子供データグループ名
                    const children_name = 'todohukens';

                    // 子供データのチェックを変更
                    for (let index = 0; index < object[children_name].length; index++) {
                        const child = object[children_name][index];
                        child.checked = object.checked;

                        // 子孫データのチェックを変更
                        changeTodohukenChildrenChecked(child);
                    }
                    //チェックが入っている子供がいるかどうか
                    object.checked_children = object.checked;
                };


                /* A-1(親->子供) todohukenの子供データのチェックを変更する関数 */
                const changeTodohukenChildrenChecked = (object) =>{
                    // 子供データグループ名
                    const children_name = 'shichosons';

                    // 子供データのチェックを変更
                    for (let index = 0; index < object[children_name].length; index++) {
                        const child = object[children_name][index];
                        child.checked = object.checked;

                        // 子孫データのチェックを変更
                        changeShichosonChildrenChecked(child);
                    }
                    //チェックが入っている子供がいるかどうか
                    object.checked_children = object.checked;
                };


                /* A-2(親->子供) shichosonの子供データのチェックを変更する関数 */
                const changeShichosonChildrenChecked = (object)=>{
                    // 子供データグループ名
                    const children_name = 'kus';

                    // 子供データのチェックを変更
                    for (let index = 0; index < object[children_name].length; index++) {
                        const child = object[children_name][index];
                        child.checked = object.checked;

                        // 子孫データのチェックを変更(なし)
                    }
                    //チェックが入っている子供がいるかどうか
                    object.checked_children = object.checked;
                };


                /* B-1(子->親) todohukenの親データのチェックを変更する関数 */
                const changeTodohukenPalentChecked = (object)=>{
                    const parent = object.parent; //親データ
                    const children = parent['todohukens']; //兄弟データ

                    parent.checked = true; //親のチェック
                    parent.checked_children = false; //チェックが入っている子供がいるかどうか
                    for (let index = 0; index < children.length; index++) {
                        const child = children[index];

                        parent.checked = ! child.checked ? false : parent.checked ;
                        parent.checked_children = child.checked ? true : ( child.checked_children ? true : parent.checked_children );
                    }

                    // 先祖データのチェックを変更
                };


                /* B-2(子->親) shichosonの親データのチェックを変更する関数 */
                const changeShichosonPalentChecked = (object)=>{
                    const parent = object.parent; //親データ
                    const children = parent['shichosons']; //兄弟データ

                    parent.checked = true; //親のチェック
                    parent.checked_children = false; //チェックが入っている子供がいるかどうか
                    for (let index = 0; index < children.length; index++) {
                        const child = children[index];

                        parent.checked = ! child.checked ? false : parent.checked ;
                        parent.checked_children = child.checked ? true : ( child.checked_children ? true : parent.checked_children );
                    }

                    // 先祖データのチェックを変更
                    changeTodohukenPalentChecked(parent);
                };


                /* B-3(子->親) kuの親データのチェックを変更する関数 */
                const changeKuPalentChecked = (object)=>{
                    const parent = object.parent; //親データ
                    const children = parent['kus']; //兄弟データ

                    parent.checked = true; //親のチェック
                    parent.checked_children = false; //チェックが入っている子供がいるかどうか
                    for (let index = 0; index < children.length; index++) {
                        const child = children[index];

                        parent.checked = ! child.checked ? false : parent.checked ;
                        parent.checked_children = child.checked ? true : parent.checked_children;
                    }

                    // 先祖データのチェックを変更
                    changeShichosonPalentChecked(parent);
                };


                /* 分岐処理 */
                switch (ob_name) {
                    case 'radion':
                        changRadionChildrenChecked(object);//(親->子供)
                        //
                        break;
                    //
                    case 'todohuken':
                        changeTodohukenChildrenChecked(object);//(親->子供)
                        changeTodohukenPalentChecked(object);//(子->親)
                        break;
                    //
                    case 'shichoson':
                        changeShichosonChildrenChecked(object);//(親->子供)
                        changeShichosonPalentChecked(object);//(子->親)
                        break;
                    //
                    case 'ku':
                        //
                        changeKuPalentChecked(object);//(子->親)
                        break;
                    //
                    default:
                        break;
                    //
                }


            }, //end changeCheckBox


            /**
             * 入力を開始する
             *
            */
            startInput: function(){
                this.copy_location = Object.assign({}, this.location); //保存データのコピー

                if(this.location.radions.length){
                    console.log(this.copy_location.radions[0].checked);
                    console.log(this.location.radions[0].checked);
                }
            },


            /**
             * 入力内容を確定する
             *
            */
            confirmInput: function(){

                //コピーデータを保存データにコピー
                this.location = Object.assign({}, this.copy_location); //保存データのコピー

                // inputsのリセット
                this.inputs = { radions:[], todohukens:[], shichosons:[], kus:[], };

                /* radion */
                const radions = this.location.radions;
                for (let rad_i = 0; rad_i < radions.length; rad_i++) {
                    const radion =  radions[rad_i];

                    // inputsに追加
                    if( radion.checked ){
                        this.inputs['radions'].push(radion.name);
                        continue;
                    }


                    /* todohuken */
                    const todohukens = radion.todohukens;
                    for (let tod_i = 0; tod_i < todohukens.length; tod_i++) {
                        const todohuken = todohukens[tod_i];

                        // inputsに追加
                        if( todohuken.checked ){
                            this.inputs['todohukens'].push(todohuken.name);
                            continue;
                        }


                        /* shichoson */
                        const shichosons = todohuken.shichosons;
                        for (let shi_i = 0; shi_i < shichosons.length; shi_i++) {
                            const shichoson = shichosons[shi_i];

                            // inputsに追加
                            if( shichoson.checked ){
                                this.inputs['shichosons'].push(shichoson.name);
                                continue;
                            }


                            /* ku */
                            const kus = shichoson.kus;
                            for (let ku_i = 0; ku_i < kus.length; ku_i++) {
                                const ku = kus[ku_i];

                                // inputsに追加
                                if( ku.checked ){
                                    this.inputs['kus'].push(ku.name);
                                    continue;
                                }

                            }

                        }
                    }
                }


                // 選択内容表示用テキスト
                const array = [...this.inputs.radions, ...this.inputs.todohukens, ...this.inputs.shichosons, ...this.inputs.kus];
                const text = array.join(' / ');

                this.inputs_text = !text ? '選択されていません' : text;
            },//end confirmInput

        },//end methods

    }
</script>
