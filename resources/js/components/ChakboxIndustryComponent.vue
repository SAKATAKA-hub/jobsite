<template>
    <div>


        <div class="d-flex align-items-center mb-3"
        >
        <!-- v-if="industry.group1.length" -->

            <!-- チェックボックス -->
            <input class="form-check-input fs-5 m-0" type="checkbox"
             id="industry_input_all"
            >

            <!-- ラベル -->
            <label class="form-check-label" for="industry_input_all">
                <h5 class="m-0 ms-1">全ての職種</h5>
            </label>
        </div>


    </div>
</template>


<script>
    export default {
        data: function() {
            return {
                csrf_token: document.querySelector('meta[name="csrf-token"]').content,
                route: {
                    wc_industry_api: document.querySelector('meta[name="wc_industry_api"]').content,
                },

                industry: {
                    cheked: false,
                    group1: [],
                }
            }
        },
        mounted() {
            // console.log(this.route.wc_industry_api);

            fetch( this.route.wc_industry_api)
            .then(response => {
                if(!response.ok){ throw new Error(); }
                return response.json();
            })
            .then(json => {
                // JSONをdataにコピー
                console.log(json);
                // this.location.radions = json.location_radions;
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
