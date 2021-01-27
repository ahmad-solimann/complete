<template>
    <div class="font-form">
        <div class="container position-relative">
            <form @submit="submit" enctype="multipart/form-data">

                <div v-if="step === 0" >
                    <Loading :active.sync="isLoading"
                             :can-cancel="false"
                             :loader="loader"
                             :on-cancel="onCancel"
                             :width="110"
                             :height="110"
                             :opacity="1"
                    ></Loading>
                    <br>
                    <div class="row align-content-center">
                        <div class="col-lg-4 col-md-4 col-sm-6 centered" v-for="(child,childname) in childs">
                            <div @click.prevent="next(child.category_details_id)" v-tooltip="child.description ? child.description : 'no Description'" class="card" style="width: 16rem; cursor:pointer;">
                                <img class="card-img-top card-image" :src="child.image_icon"  alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-title text-center"><strong>{{titleCase(child.name)}}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <fieldset v-if="step === 1">
                    <div class="vld-parent panel-body">
                        <Loading :active.sync="isLoading"
                                 :can-cancel="false"
                                 :loader="loader"
                                 :on-cancel="onCancel"
                                 :width="110"
                                 :height="110"
                                 :opacity="1"
                        ></Loading>
                        <br>
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 centered" v-for="child in childs">
                                <div @click.prevent="getchilds(child.category_details_id)" class="card" v-tooltip="child.description ? child.description : 'no Description'"  style="width: 16rem; cursor:pointer;">
                                    <img v-if="child.image_icon != null" class="card-img-top card-image" :src="child.image_icon"  alt="Card image cap">
                                    <img v-else-if="child.image != null" class="card-img-top" style="width: 16rem; height: 14rem;  border-radius: 12px; padding: 5px;" v-bind:src="mouseOverCheck === child.id ? child.image : child.image_opacity" v-on:mouseover="mouseOverCheck = child.id"  v-on:mouseout="mouseOverCheck = ''"/>
                                    <div v-if="child.image === null" class="card-body">
                                        <h5 class="card-title text-center">{{titleCase(child.name)}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button @click.prevent="prev()" class="btn">{{__('previous')}}</button>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <div>

                            <b-modal ref="my-modal"  hide-footer>
                                <div v-if="!success">
                                    <div v-bind:class="{lnag:true ,'text-right':lang}" v-if="errors.length" class="alert alert-dark" role="alert">
                                        <b>{{__('Please correct the following error(s):')}}</b>
                                        <ul>
                                            <li v-for="error in errors">{{ error }}</li>
                                        </ul>
                                    </div>
                                    <div class="row" v-if="!auth">
                                        <div class="col" v-bind:class="{lnag:true ,'text-right':lang}">
                                            <b-form-group
                                                    id="input-group-1"
                                                    :label="__('Email')"
                                                    label-for="input-1"
                                                    :description="__('We will never share your email with anyone else.')"
                                            >
                                                <b-form-input
                                                        id="input-1"
                                                        v-model="project.email"
                                                        type="email"
                                                        :placeholder="__('Email')"
                                                        required
                                                ></b-form-input>
                                            </b-form-group>
                                        </div>
                                        <div class="col" v-bind:class="{lnag:true ,'text-right':lang}">
                                            <b-form-group
                                                    id="input-group-2"
                                                    :label="__('Phone')"
                                                    label-for="input-2"
                                                    :description="__('We will never share your Phone with anyone else.')"
                                            >
                                                <b-form-input
                                                        id="input-2"
                                                        v-model="project.phone"
                                                        type="phone"
                                                        :placeholder="__('Enter Phone number')"
                                                        required
                                                ></b-form-input>
                                            </b-form-group>
                                        </div>
                                    </div>

                                    <b-form-group
                                            v-bind:class="{lnag:true ,'text-right':lang}"
                                            id="input-group-3"
                                            :label="__('Address')"
                                            label-for="input-3"

                                    >

                                        <b-form-input
                                                id="input-3"
                                                v-model="project.address"
                                                type="text"
                                                :placeholder="__('Enter address')"
                                                required
                                        ></b-form-input>
                                    </b-form-group>

                                    <b-form-group v-bind:class="{lnag:true ,'text-right':lang}" v-if="styles.length" id="input-group-4" :label="__('Style')" label-for="input-4">
                                        <b-form-select
                                                id="input-4"
                                                v-model="project.style_id"
                                                :options="styles"
                                                value-field="id"
                                                text-field="name"
                                                required
                                        ></b-form-select>
                                    </b-form-group>
                                    <b-form-group id="input-group-5" v-bind:class="{lnag:true ,'text-right':lang}" :label="__('Files')" label-for="input-5">
                                        <b-form-file
                                                id="input-5"
                                                v-model="file"
                                                :state="Boolean(file)"
                                                ref="file"
                                                multiple="multiple"
                                                :placeholder="__('Choose a file or drop it here...')"
                                                :drop-placeholder="__('Drop file here...')"
                                        ></b-form-file>
                                    </b-form-group>
                                    <b-form-group id="input-group-6" v-bind:class="{lnag:true ,'text-right':lang}" :label="__('Description')" label-for="input-6">
                                        <b-form-textarea
                                                id="input-6"
                                                v-model="project.description"
                                                :placeholder="__('Enter something...')"
                                                rows="2"
                                                max-rows="6"
                                        ></b-form-textarea>
                                    </b-form-group>

                                    <div class="text-center">
                                        <b-button type="submit" @click="submit" pill align-v="text-center">{{__('Confirm')}}</b-button>
                                    </div>

                                </div>
                                <div v-if="success">
                                    <div class="card-body pt-0">
                                        <h4 class="heading mb-4 pb-1 text-center">{{__('Confirmation')}}</h4>
                                        <p class="text-center">{{__('Form has been submitted Successfully !')}} <br>{{__('You will recieve estimation on your email id and contact no.')}}
                                        </p>
                                    </div>
                                </div>
                            </b-modal>
                        </div>
                    </div>
                </fieldset>
                <fieldset v-if="step === 2 && this.childs.length !== 0">

                    <div class="vld-parent panel-body">
                        <Loading :active.sync="isLoading"
                                 :can-cancel="false"
                                 :loader="loader"
                                 :on-cancel="onCancel"
                                 :width="110"
                                 :height="110"
                                 :opacity="1"
                        ></Loading>
                        <br>
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 centered" v-for="child in childs">
                                <div v-on:click="getstyle(child.category_details_id)" @click.prevent="getchilds(child.category_details_id)" class="card" v-tooltip="child.description ? child.description : 'no Description'" style="width: 16rem; cursor:pointer;">
                                    <img v-if="child.image_icon != null" class="card-img-top card-image" :src="child.image_icon"  alt="Card image cap">
                                    <img v-else-if="child.image != null" class="card-img-top" style="width: 16rem; height: 14rem; border-radius: 12px; padding: 5px;" v-bind:src="mouseOverCheck === child.id ? child.image : child.image_opacity" v-on:mouseover="mouseOverCheck = child.id"  v-on:mouseout="mouseOverCheck = ''"/>
                                    <div v-if="child.image === null" class="card-body">
                                        <h6 class="card-text text-center">{{titleCase(child.name)}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button @click.prevent="prev()" class="btn">previous</button>

                    </div>
                    <div class="col-md-6 offset-md-3">
                        <div>

                            <b-modal ref="my-modal"  hide-footer>
                                <div v-if="!success">
                                    <div v-bind:class="{lnag:true ,'text-right':lang}" v-if="errors.length" class="alert alert-dark" role="alert">
                                        <b>{{__('Please correct the following error(s):')}}</b>
                                        <ul>
                                            <li v-for="error in errors">{{ error }}</li>
                                        </ul>
                                    </div>
                                    <div class="row" v-if="!auth">
                                        <div class="col" v-bind:class="{lnag:true ,'text-right':lang}">
                                            <b-form-group
                                                    id="input-group-1"
                                                    :label="__('Email')"
                                                    label-for="input-1"
                                                    :description="__('We will never share your email with anyone else.')"
                                            >
                                                <b-form-input
                                                        id="input-1"
                                                        v-model="project.email"
                                                        type="email"
                                                        :placeholder="__('Email')"
                                                        required
                                                ></b-form-input>
                                            </b-form-group>
                                        </div>
                                        <div class="col" v-bind:class="{lnag:true ,'text-right':lang}">
                                            <b-form-group
                                                    id="input-group-2"
                                                    :label="__('Phone')"
                                                    label-for="input-2"
                                                    :description="__('We will never share your Phone with anyone else.')"
                                            >
                                                <b-form-input
                                                        id="input-2"
                                                        v-model="project.phone"
                                                        type="phone"
                                                        :placeholder="__('Enter Phone number')"
                                                        required
                                                ></b-form-input>
                                            </b-form-group>
                                        </div>
                                    </div>

                                    <b-form-group
                                            v-bind:class="{lnag:true ,'text-right':lang}"
                                            id="input-group-3"
                                            :label="__('Address')"
                                            label-for="input-3"

                                    >

                                        <b-form-input
                                                id="input-3"
                                                v-model="project.address"
                                                type="text"
                                                :placeholder="__('Enter address')"
                                                required
                                        ></b-form-input>
                                    </b-form-group>

                                    <b-form-group v-bind:class="{lnag:true ,'text-right':lang}" v-if="styles.length" id="input-group-4" :label="__('Style')" label-for="input-4">
                                        <b-form-select
                                                id="input-4"
                                                v-model="project.style_id"
                                                :options="styles"
                                                value-field="id"
                                                text-field="name"
                                                required
                                        ></b-form-select>
                                    </b-form-group>
                                    <b-form-group id="input-group-5" v-bind:class="{lnag:true ,'text-right':lang}" :label="__('Files')" label-for="input-5">
                                        <b-form-file
                                                id="input-5"
                                                v-model="file"
                                                :state="Boolean(file)"
                                                ref="file"
                                                multiple="multiple"
                                                :placeholder="__('Choose a file or drop it here...')"
                                                :drop-placeholder="__('Drop file here...')"
                                        ></b-form-file>
                                    </b-form-group>
                                    <b-form-group id="input-group-6" v-bind:class="{lnag:true ,'text-right':lang}" :label="__('Description')" label-for="input-6">
                                        <b-form-textarea
                                                id="input-6"
                                                v-model="project.description"
                                                :placeholder="__('Enter something...')"
                                                rows="2"
                                                max-rows="6"
                                        ></b-form-textarea>
                                    </b-form-group>

                                    <div class="text-center">
                                        <b-button type="submit" @click="submit" pill align-v="text-center">{{__('Confirm')}}</b-button>
                                    </div>

                                </div>
                                <div v-if="success">
                                    <div class="card-body pt-0">
                                        <h4 class="heading mb-4 pb-1 text-center">{{__('Confirmation')}}</h4>
                                        <p class="text-center">{{__('Form has been submitted Successfully !')}} <br>{{__('You will recieve estimation on your email id and contact no.')}}
                                        </p>
                                    </div>
                                </div>
                            </b-modal>
                        </div>
                    </div>
                </fieldset>
                <fieldset v-else-if="step === 3 && this.childs.length !== 0">
                    <div class="vld-parent panel-body">

                        <Loading :active.sync="isLoading"
                                 :can-cancel="false"
                                 :loader="loader"
                                 :on-cancel="onCancel"
                                 :width="110"
                                 :height="110"
                                 :opacity="1"
                        ></Loading>
                        <br>
                        <div class="row align-content-center">
                            <div  class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 centered" v-for="child in childs" >
                                <div  v-on:click="getstyle(child.category_details_id)" @click.prevent="getchilds(child.category_details_id)" class="card" v-tooltip="child.description ? child.description : 'no Description'"  style="width: 16rem; cursor:pointer;">
                                    <img v-if="child.image_icon != null"  class="card-img-top card-image" :src="child.image_icon"  alt="Card image cap">
                                    <img v-else-if="child.image != null" class="card-img-top" style="width: 16rem; height: 14rem; border-radius: 12px; padding: 5px;" v-bind:src="mouseOverCheck === child.id ? child.image : child.image_opacity" v-on:mouseover="mouseOverCheck = child.id"  v-on:mouseout="mouseOverCheck = ''"/>
                                    <div v-if="child.image === null" class="card-body">
                                        <h6 class="card-text text-center">{{titleCase(child.name)}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button @click.prevent="prev()" class="btn">previous</button>

                    </div>
                    <div class="col-md-6 offset-md-3">
                        <div>

                            <b-modal ref="my-modal"  hide-footer>
                                <div v-if="!success">
                                    <div v-bind:class="{lnag:true ,'text-right':lang}" v-if="errors.length" class="alert alert-dark" role="alert">
                                        <b>{{__('Please correct the following error(s):')}}</b>
                                        <ul>
                                            <li v-for="error in errors">{{ error }}</li>
                                        </ul>
                                    </div>
                                    <div class="row" v-if="!auth">
                                        <div class="col" v-bind:class="{lnag:true ,'text-right':lang}">
                                            <b-form-group
                                                    id="input-group-1"
                                                    :label="__('Email')"
                                                    label-for="input-1"
                                                    :description="__('We will never share your email with anyone else.')"
                                            >
                                                <b-form-input
                                                        id="input-1"
                                                        v-model="project.email"
                                                        type="email"
                                                        :placeholder="__('Email')"
                                                        required
                                                ></b-form-input>
                                            </b-form-group>
                                        </div>
                                        <div class="col" v-bind:class="{lnag:true ,'text-right':lang}">
                                            <b-form-group
                                                    id="input-group-2"
                                                    :label="__('Phone')"
                                                    label-for="input-2"
                                                    :description="__('We will never share your Phone with anyone else.')"
                                            >
                                                <b-form-input
                                                        id="input-2"
                                                        v-model="project.phone"
                                                        type="phone"
                                                        :placeholder="__('Enter Phone number')"
                                                        required
                                                ></b-form-input>
                                            </b-form-group>
                                        </div>
                                    </div>

                                    <b-form-group
                                            v-bind:class="{lnag:true ,'text-right':lang}"
                                            id="input-group-3"
                                            :label="__('Address')"
                                            label-for="input-3"

                                    >

                                        <b-form-input
                                                id="input-3"
                                                v-model="project.address"
                                                type="text"
                                                :placeholder="__('Enter address')"
                                                required
                                        ></b-form-input>
                                    </b-form-group>

                                    <b-form-group v-bind:class="{lnag:true ,'text-right':lang}" v-if="styles.length" id="input-group-4" :label="__('Style')" label-for="input-4">
                                        <b-form-select
                                                id="input-4"
                                                v-model="project.style_id"
                                                :options="styles"
                                                value-field="id"
                                                text-field="name"
                                                required
                                        ></b-form-select>
                                    </b-form-group>
                                    <b-form-group id="input-group-5" v-bind:class="{lnag:true ,'text-right':lang}" :label="__('Files')" label-for="input-5">
                                        <b-form-file
                                                id="input-5"
                                                v-model="file"
                                                :state="Boolean(file)"
                                                ref="file"
                                                multiple="multiple"
                                                :placeholder="__('Choose a file or drop it here...')"
                                                :drop-placeholder="__('Drop file here...')"
                                        ></b-form-file>
                                    </b-form-group>
                                    <b-form-group id="input-group-6" v-bind:class="{lnag:true ,'text-right':lang}" :label="__('Description')" label-for="input-6">
                                        <b-form-textarea
                                                id="input-6"
                                                v-model="project.description"
                                                :placeholder="__('Enter something...')"
                                                rows="2"
                                                max-rows="6"
                                        ></b-form-textarea>
                                    </b-form-group>

                                    <div class="text-center">
                                        <b-button type="submit" @click="submit" pill align-v="text-center">{{__('Confirm')}}</b-button>
                                    </div>

                                </div>
                                <div v-if="success">
                                    <div class="card-body pt-0">
                                        <h4 class="heading mb-4 pb-1 text-center">{{__('Confirmation')}}</h4>
                                        <p class="text-center">{{__('Form has been submitted Successfully !')}} <br>{{__('You will recieve estimation on your email id and contact no.')}}
                                        </p>
                                    </div>
                                </div>
                            </b-modal>
                        </div>
                    </div>
                </fieldset>
            </form>
            <!--<div>-->
            <!--<div class="card-body pt-0">-->
            <!--<h4 class="heading mb-4 pb-1 text-center">Confirmation</h4>-->
            <!--<p class="text-center">Form has been submitted Successfully ! <br>You will recieve estimation on your email id-->
            <!--and contact no.</p>-->
            <!--</div>-->
            <!--</div>-->
        </div>


    </div>
</template>
<script>

    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';
    import { ModalPlugin } from 'bootstrap-vue'
    import { FormPlugin } from 'bootstrap-vue'

    // import _ from 'lodash';
    // Vue.prototype.__ = string => _.get(window.VueI18n, string);

    export default {
        data() {
            return {
                lang:false,
                auth:false,
                success:false,
                file:[],
                successes:[],
                styles:[],
                budgets:{
                    budget_from:'',
                    budget_to:'',
                },
                steps:[],
                errors:[],
                step: 0,
                project:{
                    style_id:'' ,
                    category_id:'',
                    email:'',
                    phone:'',
                    address:'',
                    description:''
                },
                mouseOverCheck: '',
                childs:[],
                child:[],
                isLoading: false,
                fullPage: true,
                loader:"dots",
                show:false


            }
        },
        created(){
            this.getchild(parent);
            this.isAuth();

        },
        methods:{
            prev() {
                this.isLoading = true;
                setTimeout(()=>{
                    axios.get('grandparent/'+ this.steps[this.steps.length -1]).then(response=>{this.childs = response.data;});
                    this.steps.pop();
                    this.step--;
                    this.isLoading = false;
                },3000)
            },
            next(parent) {

                axios.get('category/'+ parent).then(response=>{this.childs = response.data;

                });
                if (this.childs.length !== 0) {
                    this.isLoading = true;
                    setTimeout(() => {
                        this.project.category_id = parent;
                        this.step++;
                        this.steps.push(parent);
                        this.isLoading = false;
                        this.Arabic()
                    },3000);
                }
            },
            submit(e) {
                console.log(this.project);
                let formData = new FormData();
                for( var i = 0; i < this.$refs.file.files.length; i++ ){
                    let file = this.$refs.file.files[i];
                    formData.append('files[' + i + ']', file);
                }
                formData.append('category_id', this.project.category_id);
                formData.append('style_id', this.project.style_id);
                formData.append('phone', this.project.phone);
                formData.append('email', this.project.email);
                formData.append('address',this.project.address);
                formData.append('description',this.project.description);
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };
                if(!this.auth ){
                    if ( this.project.email && this.project.phone) {
                        axios.post('createproject',formData,config).then(res =>{
                            this.success = true;
                        }).catch(err=>{
                            this.errors.push(err);
                        });
                    }
                    this.errors = [];
                    if (!this.project.email) {
                        this.errors.push( this.__("Email Address required.")  );
                    }
                    if (!this.project.phone) {
                        this.errors.push(this.__('Phone Number required.'));
                    }
                }else{
                    axios.post('createproject',formData,config).then(res =>{

                        this.success = true;

                    }).catch(err=>{
                        this.errors.push(err);
                    });
                }
                e.preventDefault();
            },
            getchild(){
                axios.get('category').then(response=>{
                    this.childs = response.data;

                })
            },
            getstyle(style_id){
                axios.get('styles/'+ style_id).then(res=>{
                    this.styles = res.data;
                })
            },
            sum(){
                this.project.budget = this.budgets.budget_from + '-'+ this.budgets.budget_to +'$' ;
            },
            isAuth(){
                axios.get('isAuth').then(res=>{
                    this.auth = res.data;
                })
            },
            onCancel() {
                console.log('User cancelled the loader.')
            },
            showModal(child) {
                this.project.category_id = child;
                this.$refs['my-modal'].show()
            },
            getchilds(parent){
                let child = [];
                console.log(parent);
                axios.get('category/'+ parent).then(response=>{
                    child = response.data;
                    if (child.length !== 0){

                        this.next(parent)
                    } else {
                        this.showModal(parent)
                    }
                });


            },
            titleCase(str) {
                var splitStr = str.toLowerCase().split(' ');
                for (var i = 0; i < splitStr.length; i++) {
                    splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
                }
                return splitStr.join(' ');
            },


            Arabic() {
                if (this.__("Email") !== "Email") {
                    this.lang = true;
                } else {
                    this.lang = false
                }
            }

        },
        components: {
            Loading,
            FormPlugin,
            ModalPlugin
        },
    }
</script>

<style scoped>
    .Arabic{

    }
    .font-form{
        font-family: HelveticaNowDisplay, sans-serif;
    }

    .card-image{
        width: 90px;
        height: 90px;
        margin: auto;
        padding: 10px;
    }
    .card-image:hover{
        opacity: 1;

    }
    button {
        background:black;
        color:#c6c8ca ;
    }
    button:hover{
        background:#c6c8ca;
        color: #0c0c0c;
    }
    .card:hover{
        background: #0c0c0c;
        color: #c6c8ca;
        box-shadow: 5px 5px 5px dimgrey;
    }
    .centered{
        display: flex;
        justify-content: center;
    }

</style>