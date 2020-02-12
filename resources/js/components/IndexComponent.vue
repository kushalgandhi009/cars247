<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Tab-1</div>
                <div class="card-body">
                    <form v-on:change="updateCar">
                        <div class="form-group">
                            <label for="case">Case</label>
                            <input type="text" class="form-control" name="case" id="case" v-model="getCase"/>
                        </div>

                        <div class="form-group">
                            <label for="make">Make</label>
                            <select id="make" name="make" class="form-control" v-model="selectedCarCompany">
                                <option v-for="(value, key) in car_company_list" :key="value" :value="value">{{value}}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="model">Model</label>
                            <select id="model" name="model" class="form-control" v-model="selectedCarModel">
                                <option v-for="(value, key) in car_company_model" :key="value" :value="value">{{value}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mileage">Mileage</label>
                            <input type="number" class="form-control" name="mileage" id="mileage" v-model="getMileage" />
                        </div>
                        <div class="form-group">
                            <label for="buying_date">Buying Date</label>
                            <input type="date" class="form-control" name="buying_date" id="buying_date" v-model="getDate" />
                        </div>
                        <div class="form-group">
                            <label for="color">Color</label>
                            <select id="color" name="color" class="form-control" v-model="selectedCarColor">
                                <option v-for="(value, key) in car_company_color" :key="value" :value="value">{{value}}</option>
                            </select>
                        </div>
                        <div class="form-group" v-if="selectedCarModel == 'Grand Cherokee'">
                            <label for="drivetrain">Drivetrain</label>
                            <select id="drivetrain" name="drivetrain" class="form-control" v-model="selectedCarDrivetrain">
                                <option v-for="(value, key) in car_company_drivetrain" :key="value" :value="value">{{value}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="picture">Picture</label>
                            <input type="file" class="form-control" name="picture" id="picture" />
                        </div>
                        <button type="submit" class="btn btn-primary">get quote</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                getCase : '',
                selectedCarCompany : '',
                selectedCarModel : '',
                getMileage : '',
                getDate : '',
                selectedCarColor : '',
                selectedCarDrivetrain : '',
                car_company_list : [],
                car_company_model : [],
                car_company_color : [],
                car_company_drivetrain : [],
            }
        },

        created() {
            axios.get('/get_created_data')
                .then((response) => {
                    this.car_company_list = response.data;
                    console.log("car_company_list",this.car_company_list);
                })
                .catch((error) => console.log(error))

        },
        mounted() {
            console.log('Index Component mounted.')
        },
        methods: {
            updateCar(get_data) {
                 //console.log("update form");
                //console.log("this.selectedList",this.selectedCarCompany);

                axios.post('/get_changed_data',{
                    'getCase':this.getCase,
                    'selectedCarCompany':this.selectedCarCompany,
                    'selectedCarModel':this.selectedCarModel,
                    'getMileage':this.getMileage,
                    'getDate' : this.getDate,
                    'selectedCarColor':this.selectedCarColor,
                    'selectedCarDrivetrain' : this.selectedCarDrivetrain,
                })
                    .then((response) => {
                        console.log("Changed success",response);
                        this.car_company_model = response.data['get_all_car_model'];
                        this.car_company_color = response.data['get_all_car_color'];
                        this.car_company_drivetrain = response.data['get_car_drivetrain'];
                    })
                    .catch((error) => console.log(error))
            },

        }
    }
</script>
