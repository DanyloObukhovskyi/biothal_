<template>
    <div class="page-form__wrapper">
        <div class="page-form__top">
            <div class="page-form__top__title">Мой профиль</div>
            <div class="user-image__wrapper">
                <div v-if="change_profile.image_id"
                    class="user-image__no-image" @click="changeImage()">
                    <img class="user-image__no-image"
                         width="100%" :src="change_profile.image ? this.api+'/storage/img/users/' + change_profile.image.name : ''"/>
<!--                    </v-icon>-->
                </div>
                <div v-if="!change_profile.image_id"
                    class="user-image__no-image" @click="changeImage()">
                    <v-icon size="35" class="user-image__no-image__icon">
                        person_add
                    </v-icon>
                </div>
<!--                <div v-if="!change_profile.image_id"-->
<!--                     class="user-image__no-image" @click="changeImage()">-->
<!--                    <v-icon size="85" class="user-image__no-image__icon">-->
<!--                        person_add-->
<!--                    </v-icon>-->
<!--                </div>-->
<!--                <div v-if="change_profile.image_id"-->
<!--                     class="user-image__no-image" @click="changeImage()">-->
<!--                    <img class="user-image__no-image"-->
<!--                         width="100%" :src="change_profile.image ? this.api+'/storage/img/users/' + change_profile.image.name : ''"/>-->
<!--                </div>-->
                <input style="display: none" type="file" ref="file" id="input_file" class="input_file" v-on:change="handleFileUpload()"/>
                <div class="user-image__text">
                    <div v-if="!change_profile.image_id" @click="changeImage()">
                        Загрузить фото
                    </div>
                    <div v-if="change_profile.image_id" @click="deleteImage()" class="second-text">
                        <v-icon size="10">
                            close
                        </v-icon>
                        Удалить фото
                    </div>
                </div>
            </div>
        </div>
        <div class="page-form__middle">
            <v-form ref="changeProfile" style="width: 100%;" v-model="validProfile">
                <div>
                    <p class="main-input-label" style="margin: 0">Введите имя</p>
                    <v-text-field
                        class="main-input-field"
                        v-model="change_profile.name"
                        :error-messages="errorValid.name"
                        :rules="nameRules"
                        flat
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите фамилию</p>
                    <v-text-field
                        class="main-input-field"
                        v-model="change_profile.sur_name"
                        :error-messages="errorValid.sur_name"
                        flat
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите дату</p>
                    <v-text-field
                        class="main-input-field"
                        placeholder="****-**-**"
                        v-mask="'####-##-##'"
                        prop="date"
                        v-model="change_profile.date_of_birth"
                        :error-messages="errorValid.date_of_birth"
                        flat
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите номер телефона</p>
                    <v-text-field
                        placeholder="+38(___) ___-__-__"
                        v-mask="'+38(###) ###-##-##'"
                        v-model="change_profile.phone_number"
                        :error-messages="errorValid.phone_number"
                        :rules="phoneRules"
                        class="main-input-field"
                        flat
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите email</p>
                    <v-text-field
                        class="main-input-field"
                        v-model="change_profile.email"
                        :error-messages="errorValid.email"
                        :rules="emailRules"
                        flat
                        rounded/>
                </div>
            </v-form>
        </div>
        <div class="remember-me">
            <div>
                <v-checkbox
                    v-model="rememberMe"/>
            </div>
            <div class="remember-me__right">
                Не хочу получать писем с акциями
            </div>
        </div>
        <div class="page-form__top">
            <div class="page-form__top__title">Я хочу поменять пароль</div>
        </div>
        <div class="page-form__middle">
            <v-form style="width: 100%;">
                <div>
                    <p class="main-input-label">Введите старый пароль</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите новый пароль</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите еще раз новый пароль</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        rounded/>
                </div>
            </v-form>
        </div>
        <div class="page-form__bottom">
            <v-btn dark class="checkout-button" elevation="0" @click="changeProfile()">
                Сохранить данные
            </v-btn>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AccountSettingsMobile",
        data() {
            return {
                errorValid: {
                    old_password: '',
                    password: '',
                    password_confirmation: '',
                    name: '',
                    surname: '',
                    date_of_birth: '',
                    email: '',
                    phone_number: ''
                },
                validProfile: false,
                rememberMe: false,
                dialog: false,
                valid: false,
                file: '',
                oldPassRules: [
                    v => !!v || 'Вы не ввели старый пароль',
                    v => v.length >= 6 || 'Пароль должен содержать больше чем 6 символов',
                ],
                passRules: [
                    v => !!v || 'Вы не ввели пароль',
                    v => v.length >= 6 || 'Пароль должен содержать больше чем 6 символов',
                    v => v !== this.change_password.old_password || 'Новый пароль не должен содержать старый'
                ],
                passConfirmRules: [
                    v => !!v || 'Вы не подтвердили пароль',
                    v => v.length >= 6 || 'Пароль должен содержать больше чем 6 символов',
                    v => v === this.change_password.password || 'Пароли не совпадают'
                ],
                nameRules: [
                    v => !!v || 'Вы не ввели свое имя',
                    v => v.length >= 2 || 'Имя должно содержать больше чем 2 символа',
                ],
                emailRules: [
                    v => !!v || 'Вы не ввели електронную почту',
                    v => /.+@.+/.test(v) || 'Електронная почта не коректна',
                ],
                phoneRules: [
                    v => !!v || 'Вы не ввели свое телефоный номер',
                    v => v.length >= 12 || 'Телефон должен содержать больше чем 12 символа',
                ],
                change_password:{
                    old_password: '',
                    password: '',
                    password_confirmation: ''
                },
                change_profile: {
                    name: '',
                    surname: '',
                    date: '',
                    email: '',
                    phone_number: '',
                    is_receive: ''
                }
            }
        },
        mounted() {
            this.fetchProfile()
        },
        methods: {
            async fetchProfile(){
                try {
                    const token = this.$store.getters.getToken;
                    if(token){
                        let data = await this.axios.post('profile', {

                        },  {
                            headers: {
                                'Authorization': `Bearer ${token}`
                            }
                        });
                        if(data){
                            let profile = data.data.user
                            this.change_profile = profile
                            this.change_profile.is_receive = profile.email_receive.is_receive
                        }
                    }
                } catch (e) {
                    this.errorMessagesValidation(e);
                }
                //console.log(this.$parent.profile)
            },
            async changePassword(){
                try {
                    this.$loading(true)
                    this.clearValidation()
                    let validate = await this.$refs['change'].validate();

                    if(validate){
                        const token = this.$store.getters.getToken;
                        if(token){
                            let data = await this.axios.post('changePassword', this.change_password,
                                {
                                    headers: {
                                        'Authorization': `Bearer ${token}`
                                    }
                                });
                            if(data){
                                let message = data.data.message
                                this.$notify({
                                    type: 'success',
                                    title: 'Успех!',
                                    text: message
                                });
                                this.closeModal()
                            }
                        }
                    }
                    this.$loading(false)
                } catch (e) {
                    this.$loading(false)
                    this.errorMessagesValidation(e);
                }
            },
            clearValidation(){
                this.errorValid.old_password = '',
                    this.errorValid.password = '',
                    this.errorValid.password_confirmation = '',
                    this.errorValid.name = '',
                    this.errorValid.surname =  '',
                    this.errorValid.date_of_birth =  '',
                    this.errorValid.email = '',
                    this.errorValid.phone_number = ''
            },
            closeModal(){
                this.clearValidation()
                this.$refs.change.reset()
                this.dialog = false
            },
            async changeProfile(){
                try {
                    this.$loading(true)
                    this.clearValidation()
                    let validate = await this.$refs['changeProfile'].validate();

                    if(validate){
                        const token = this.$store.getters.getToken;
                        if(token){
                            let data = await this.axios.post('updateProfile', this.change_profile,
                                {
                                    headers: {
                                        'Authorization': `Bearer ${token}`
                                    }
                                });
                            if(data){
                                let message = data.data.message
                                this.$notify({
                                    type: 'success',
                                    title: 'Успех!',
                                    text: message
                                });
                                this.clearValidation()
                            }
                        }
                    }
                    this.$loading(false)
                } catch (e) {
                    this.$loading(false)
                    this.errorMessagesValidation(e);
                }
            },
            changeImage(){
                document.getElementById('input_file').click();
            },
            async handleFileUpload(){
                this.$loading(true)
                this.file = this.$refs.file.files[0];
                try{
                    const token = this.$store.getters.getToken;
                    if(token) {
                        let formData = new FormData();
                        formData.append('img', this.file);
                        let data = await this.axios.post('addImage',
                            formData,
                            {
                                headers: {
                                    'Content-Type': 'multipart/form-data',
                                    'Authorization': `Bearer ${token}`
                                }
                            }
                        )
                        if(data){
                            let message = data.data.message
                            this.$notify({
                                type: 'success',
                                title: 'Успех!',
                                text: message
                            });
                            let profile = data.data.profile
                            this.change_profile = profile
                        }
                    }
                    this.$loading(false)
                } catch (e) {
                    this.$loading(false)
                    this.errorMessagesValidation(e);
                }
            },
            async deleteImage()
            {
                this.$loading(true)
                const token = this.$store.getters.getToken;
                try{
                    if(token){
                        let data = await this.axios.post('deleteImage',{},
                            {
                                headers: {
                                    'Authorization': `Bearer ${token}`
                                }
                            });
                        if(data){
                            let message = data.data.message
                            this.$notify({
                                type: 'success',
                                title: 'Успех!',
                                text: message
                            });
                            let profile = data.data.profile
                            this.change_profile = profile
                        }
                    }
                    this.$loading(false)
                } catch (e) {
                    this.$loading(false)
                    this.errorMessagesValidation(e);
                }
            }
        }
    }
</script>

<style scoped lang="scss">
    .page-form {
        &__wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: scroll;
            padding: 20px 20px 15px 20px;
        }

        &__top {
            display: flex;
            flex-direction: column;
            text-align: center;

            &__title {
                font-size: 14px;
                line-height: 19px;
                font-weight: 700;
            }
        }

        &__middle {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        &__bottom {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
    }

    .main-input-label {
        font-weight: 200;
        font-size: 12px;
        line-height: 16px;
        color: #7E7E7E;
        margin: 15px 0 0 0;
    }

    .main-input-field {
        width: 100%;
        height: 54px;
        background: #fff;
        border-radius: 2px;
    }

    .remember-me {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        font-size: 14px;
        margin-top: 15px;

        &__right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
    }

    .user-image {
        &__wrapper {
            display: flex;
            margin: 20px 20px 0 20px;
            column-gap: 10px;
        }

        &__no-image {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background-color: #fff;
            width: 80px;
            height: 80px;

            &__icon {
                color: #D2D2D2;
            }
        }

        &__text {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }
    }
</style>
