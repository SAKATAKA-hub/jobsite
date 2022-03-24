<template>
    <div>




        <div class="d-flex align-items-center mb-3" v-if="location.radions.length">
            <!-- チェックボックス -->
            <input class="form-check-input fs-5 m-0" type="checkbox" v-model="location.cheked"
             @change="clickRadionsParent()" id="location_input_all"

            >

            <!-- ラベル -->
            <label class="form-check-label" for="location_input_all">
                <h5 class="m-0 ms-1">全国</h5>
            </label>
        </div>


        <!-- 地域 -->
        <ul class="list-group">
            <li class="list-group-item bg-light" v-for="radion in location.radions" :key="radion.id">

                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <!-- チェックボックス -->
                        <input class="form-check-input fs-5 m-0" type="checkbox" v-model="radion.cheked"
                         @change="clickRadion(radion)" :id=" 'location_input'+ radion.id "
                        >

                        <!-- ラベル -->
                        <label class="form-check-label" :for=" 'location_input'+ radion.id ">
                            <h5 class="m-0 ms-1">{{ radion.name }}</h5>
                        </label>
                    </div>

                    <button class="btn btn-secondary" type="button"
                     data-bs-toggle="collapse" :data-bs-target=" '#location_itembox'+ radion.id "
                     aria-expanded="false" :aria-controls=" 'location_itembox'+ radion.id "
                    >open</button>
                </div>




                <!-- 都道府県 -->
                <div class="collapse" :id=" 'location_itembox'+ radion.id ">
                    <ul class="list-group m-3">
                        <li class="list-group-item bg-light bg-white" v-for="todohuken in radion.rel_todohukens" :key="todohuken.id">
                            <div class="d-flex justify-content-between">

                                <div class="d-flex align-items-center">
                                    <!-- チェックボックス -->
                                    <input class="form-check-input fs-5 m-0" type="checkbox" v-model="todohuken.cheked"
                                     @change="clickShichosonsParent(todohuken)" :id=" 'todohuken_input'+ todohuken.id "
                                    >

                                    <!-- ラベル -->
                                    <label class="form-check-label" :for=" 'todohuken_input'+ todohuken.id ">
                                        <h6 class="m-0 ms-1"> {{ todohuken.name }}</h6>
                                    </label>
                                </div>

                                <button class="btn btn-secondary" type="button"
                                data-bs-toggle="collapse" :data-bs-target=" '#todohuken_itembox'+ todohuken.id "
                                aria-expanded="false" :aria-controls=" 'todohuken_itembox'+ todohuken.id "
                                >open</button>
                            </div>




                            <!-- 市町村 -->
                            <div class="collapse" :id=" 'todohuken_itembox'+ todohuken.id ">
                                <ul class="list-group m-3">
                                    <li class="list-group-item bg-light bg-white" v-for="shichoson in todohuken.rel_shichosons" :key="shichoson.id">
                                        <div class="d-flex justify-content-between">

                                            <div class="d-flex align-items-center">
                                                <!-- チェックボックス -->
                                                <input class="form-check-input fs-5 m-0" type="checkbox"  v-model="shichoson.cheked"
                                                 @change="clickKusParent(shichoson)" :id=" 'shichoson_input'+ shichoson.id "
                                                >

                                                <!-- ラベル -->
                                                <label class="form-check-label" :for=" 'shichoson_input'+ shichoson.id ">
                                                    <h6 class="m-0 ms-1"> {{ shichoson.name }}</h6>
                                                </label>
                                            </div>

                                            <button class="btn btn-secondary" type="button"
                                            v-if="shichoson.rel_kus.length"
                                            data-bs-toggle="collapse" :data-bs-target=" '#shichoson_itembox'+ shichoson.id "
                                            aria-expanded="false" :aria-controls=" 'shichoson_itembox'+ shichoson.id "
                                            >open</button>
                                        </div>

                                        <!-- 区 -->
                                        <div class="collapse" :id=" 'shichoson_itembox'+ shichoson.id " >
                                            <div class="d-flex flex-wrap">
                                                <div v-for="ku in shichoson.rel_kus" :key="ku.id"
                                                style="width:8em;"
                                                >
                                                    <!-- チェックボックス -->
                                                    <input class="form-check-input" type="checkbox" v-model="ku.cheked"
                                                     @change="clicKus(shichoson)" :id=" 'ku_input' +ku.id "
                                                    >

                                                    <!-- ラベル -->
                                                    <label class="form-check-label" :for=" 'ku_input' +ku.id ">
                                                        {{ ku.name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end 区 -->


                                    </li>
                                </ul>
                            </div>
                            <!-- end 市町村 -->



                        </li>
                    </ul>
                </div>
                <!-- end 都道府県 -->



            </li>
        </ul>
        <!-- end 地域 -->



    </div>
</template>




<script>
    export default {
        data: function() {
            return {
                //meta data
                csrf_token: document.querySelector('meta[name="csrf-token"]').content,
                route: {
                    wc_location_api: document.querySelector('meta[name="wc_location_api"]').content,
                },

                location: {
                    cheked: false,
                    radions: [],
                }
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
                // console.log(json.location_radions[0]);
                this.location.radions = json.location_radions;
                 console.log(this.location.radions);
            })
            .catch(error => {
                alert('データの読み込みに失敗しました。');
            });

        },
        methods: {
            /**
             * 地域のチェックボックスをクリックした時
            */
            clickRadion:function(myself){
                //子要素のチェックボックスの処理
                for (let index = 0; index < myself['rel_todohukens'].length; index++) {
                    const child = myself['rel_todohukens'][index];
                    child.cheked = myself.cheked;
                    console.log(child.name);
                    this.clickShichosonsParent(child);
                }

                //親要素のチェックボックスの処理
                this.location.cheked = true;
                for (let index = 0; index < this.location.radions.length; index++) {
                    const child = this.location.radions[index];
                    this.location.cheked = child.cheked == false ? false : this.location.cheked;
                }
           },





            // 地域全部
            clickRadionsParent:function(){
                // console.log(this.location.cheked);
                for (let index = 0; index < this.location.radions.length; index++) {
                    const child = this.location.radions[index];
                    console.log(child.name+child.checked);
                    child.cheked = this.location.cheked;
                    console.log(child.name);
                    this.clickTodohukensParent(child);
                }
            },
            // 都道府県全部
            clickTodohukensParent: function(parent){
                for (let index = 0; index < parent['rel_todohukens'].length; index++) {
                    const child = parent['rel_todohukens'][index];
                    child.cheked = parent.cheked;
                    console.log(child.name);
                    this.clickShichosonsParent(child);
                }
            },
            // 市町村全部
            clickShichosonsParent: function(parent){
                for (let index = 0; index < parent['rel_shichosons'].length; index++) {
                    const child = parent['rel_shichosons'][index];
                    child.cheked = parent.cheked;
                    console.log(child.name);
                    this.clickKusParent(child);
                }
            },
            //区全部
            clickKusParent: function(parent){
                for (let index = 0; index < parent['rel_kus'].length; index++) {
                    const child = parent['rel_kus'][index];
                    child.cheked = parent.cheked;
                    console.log(child.name);
                }
            },

            clicKus: function(parent){
                parent.checked = 1;
                // for (let index = 0; index < parent['rel_kus'].length; index++) {
                //     const child = parent['rel_kus'][index];
                //     parent.checked = child.cheked == false ? 0 : parent.checked;
                // }
                console.log(parent.name+parent.checked);
            }

        }
    }
</script>
