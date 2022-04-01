<template>
    <div>


        <div class="d-flex align-items-center mb-3" v-if="location.radions.length">
            <!-- チェックボックス -->
            <input class="form-check-input fs-5 m-0" type="checkbox" v-model="location.cheked"
             id="train_location_input_all"
            >

            <!-- ラベル -->
            <label class="form-check-label" for="train_location_input_all">
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
                        :id=" 'train_location_input'+ radion.id "
                        >

                        <!-- ラベル -->
                        <label class="form-check-label" :for=" 'train_location_input'+ radion.id ">
                            <h5 class="m-0 ms-1">{{ radion.name }}</h5>
                        </label>
                    </div>

                    <button class="btn btn-secondary" type="button"
                     data-bs-toggle="collapse" :data-bs-target=" '#train_location_itembox'+ radion.id "
                     aria-expanded="false" :aria-controls=" 'train_location_itembox'+ radion.id "
                    >open</button>
                </div>




                <!-- 都道府県 -->
                <div class="collapse" :id=" 'train_location_itembox'+ radion.id ">
                    <ul class="list-group m-3">
                        <li class="list-group-item bg-light bg-white" v-for="todohuken in radion.rel_todohukens" :key="todohuken.id">
                            <div class="d-flex justify-content-between">

                                <div class="d-flex align-items-center">
                                    <!-- チェックボックス -->
                                    <input class="form-check-input fs-5 m-0" type="checkbox" v-model="todohuken.cheked"
                                     :id=" 'train_todohuken_input'+ todohuken.id "
                                    >

                                    <!-- ラベル -->
                                    <label class="form-check-label" :for=" 'train_todohuken_input'+ todohuken.id ">
                                        <h6 class="m-0 ms-1"> {{ todohuken.name }}</h6>
                                    </label>
                                </div>

                                <button class="btn btn-secondary" type="button"
                                data-bs-toggle="collapse" :data-bs-target=" '#train_todohuken_itembox'+ todohuken.id "
                                aria-expanded="false" :aria-controls=" 'train_todohuken_itembox'+ todohuken.id "
                                >open</button>
                            </div>




                            <!-- 鉄道会社 -->
                            <div class="collapse" :id=" 'train_todohuken_itembox'+ todohuken.id ">
                                <ul class="list-group m-3">
                                    <li class="list-group-item bg-light bg-white" v-for="company in todohuken.rel_train_companys" :key="company.id">
                                        <div class="d-flex justify-content-between">

                                            <div class="d-flex align-items-center">
                                                <!-- チェックボックス -->
                                                <input class="form-check-input fs-5 m-0" type="checkbox"  v-model="company.cheked"
                                                 :id=" 'company_input'+ company.id "
                                                >

                                                <!-- ラベル -->
                                                <label class="form-check-label" :for=" 'company_input'+ company.id ">
                                                    <h6 class="m-0 ms-1"> {{ company.name }}</h6>
                                                </label>
                                            </div>

                                            <button class="btn btn-secondary" type="button"
                                            v-if="company.rel_lines.length"
                                            data-bs-toggle="collapse" :data-bs-target=" '#company_itembox'+ company.id "
                                            aria-expanded="false" :aria-controls=" 'company_itembox'+ company.id "
                                            >open</button>
                                        </div>

                                        <!-- 路線 -->
                                        <div class="collapse" :id=" 'company_itembox'+ company.id ">
                                            <ul class="list-group m-3">
                                                <li class="list-group-item bg-light bg-white" v-for="line in company.rel_lines" :key="line.id">
                                                    <div class="d-flex justify-content-between">

                                                        <div class="d-flex align-items-center">
                                                            <!-- チェックボックス -->
                                                            <input class="form-check-input fs-5 m-0" type="checkbox"  v-model="line.cheked"
                                                              :id=" 'line_input'+ line.id "
                                                            >

                                                            <!-- ラベル -->
                                                            <label class="form-check-label" :for=" 'line_input'+ line.id ">
                                                                <h6 class="m-0 ms-1"> {{ line.name }}</h6>
                                                            </label>
                                                        </div>

                                                        <button class="btn btn-secondary" type="button"
                                                        v-if="line.rel_stations.length"
                                                        data-bs-toggle="collapse" :data-bs-target=" '#line_itembox'+ line.id "
                                                        aria-expanded="false" :aria-controls=" 'line_itembox'+ line.id "
                                                        >open</button>
                                                    </div>


                                                    <!-- 駅 -->
                                                    <div class="collapse" :id=" 'line_itembox'+ line.id " >
                                                        <div class="d-flex flex-wrap">
                                                            <div v-for="station in line.rel_stations" :key="station.id"
                                                            style="width:8em;"
                                                            >
                                                                <!-- チェックボックス -->
                                                                <input class="form-check-input" type="checkbox" v-model="station.cheked"
                                                                 :id=" 'station_input' +station.id "
                                                                >

                                                                <!-- ラベル -->
                                                                <label class="form-check-label" :for=" 'station_input' +station.id ">
                                                                    {{ station.name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end 駅 -->


                                                </li>
                                            </ul>
                                        </div>
                                        <!-- end 路線 -->


                                    </li>
                                </ul>
                            </div>
                            <!-- end 鉄道会社 -->


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
                csrf_token: document.querySelector('meta[name="csrf-token"]').content,
                route: {
                    wc_train_api: document.querySelector('meta[name="wc_train_api"]').content,
                },

                location: {
                    cheked: false,
                    radions: [],
                }
            }
        },
        mounted() {
            fetch( this.route.wc_train_api)
            .then(response => {
                if(!response.ok){ throw new Error(); }
                return response.json();
            })
            .then(json => {
                // JSONをdataにコピー
                // console.log(json.location_radions[0]);
                this.location.radions = json.location_radions;
                //  console.log(this.location.radions);
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

