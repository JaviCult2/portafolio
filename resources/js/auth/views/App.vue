<template>

    <v-app class="bg-principal">

        <v-card width="500" class="container bg-container" elevation="5">

            <div class="p-3" style="background: #4D4D81">
                <h3 class="text-white"><b>Welcome</b></h3>
            </div>

            <v-card-text>

                <v-form v-model="valid" ref="form" class="mt-3">

                    <v-text-field
                        label="User"
                        v-model="credentials.user"
                        :rules="rules.user"
                        required
                        dense
                        solo
                    ></v-text-field>

                    <v-text-field
                        label="Password"
                        v-model="credentials.password"
                        :rules="rules.password"
                        required
                        dense
                        solo
                    ></v-text-field>

                </v-form>

            </v-card-text>

            <v-card-actions>
                <v-spacer/>

                <v-btn
                    v-on:click="login"
                    color="#4D4D81"
                    dark>
                    Login
                </v-btn>

            </v-card-actions>

        </v-card>

    </v-app>

</template>

<script>

import axios from 'axios';

export default {
    name: "App",
    data: () => ({
        valid: false,

        credentials:
            {
                user: '',
                password: ''
            },

        rules:
            {
                user: [v => !!v || 'The user is required'],
                password: [v => !!v || 'The password is required'],
            },
    }),
    methods:
        {
            login() {

                if (this.$refs.form.validate()) {

                    axios.post(route('login_index', this.credentials)).then(response => {

                        this.$refs.form.reset();

                        window.location = response.data;

                    }).catch(e => {
                        console.log("Error...", e)
                    })

                } else {
                    console.log("Error")
                }
            },
        },
}
</script>

<style scoped>

.bg-principal {
    background: #2d3748 !important;
}

.bg-container {
    margin: auto;
    border-radius: 10px;
    background: #2d3748
}

</style>
