<template>

    <v-app class="container-fluid bg-principal">

        <v-card>

            <v-card-text>

                <v-form v-model="valid" ref="form" class="mt-3">

                    <v-text-field
                        label="Name"
                        v-model="credentials.user"
                        :rules="rules.name"
                        required
                        dense
                        solo
                    ></v-text-field>

                    <v-text-field
                        label="Project Manager"
                        v-model="credentials.password"
                        :rules="rules.manager"
                        required
                        dense
                        solo
                    ></v-text-field>

                </v-form>

            </v-card-text>

            <v-card-actions>
                <v-spacer/>

                <v-btn
                    v-on:click="login">
                    Login
                </v-btn>

            </v-card-actions>

        </v-card>

    </v-app>

</template>

<script>

import axios from 'axios';
import ProjectDetail from "../../admin/components/ProjectDetail";

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
                name: [v => !!v || 'The name is required'],
                manager: [v => !!v || 'The project manager is required'],
                description: [v => !!v || 'The description is required'],
                enterprise: [v => !!v || 'The enterprise is required'],
                developers: [v => !!v || 'The developers is/are required'],
            },
    }),
    methods:
        {
            login() {

                axios.get(route('login_index', this.credentials)).then(response => {

                    console.log("response", response)
                    window.location = response.data;

                }).catch(e => {
                    console.log("Error...", e)
                })

                //window.location = "admin/app/home";
            }
        },
}
</script>

<style scoped>

.c-pink {
    background: #BE74B5 !important;
}

.c-blue {
    background: #4D4D81 !important;
}

.c-green {
    background-color: #1ABC9C !important;
}

.c-red {
    background-color: #C70039 !important;
}

.c-purple {
    background-color: #450A3B !important;
}

.bg-principal {
    background: #2d3748 !important;
}


</style>
