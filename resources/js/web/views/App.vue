<template>

    <v-app class="container-fluid bg-principal">

        <div class="row">

            <div class="col-12 col-sm-4 my-5 d-flex justify-content-center align-items-start"
                 v-for="(item,index) of projects" :key="index">

                <v-card class="card-round" min-width="200" max-width="350" color="#F0B27A">

                    <v-card-text class="container">

                        <div class="row d-flex mb-5">
                            <div class="col-5" style="height: 1rem"></div>
                            <div class="col-7" style="background: #2d3748; height: 1rem"></div>
                        </div>

                        <v-chip-group column>

                            <v-chip class="col-12 text-white c-blue">
                                <b class="mr-1">Name: </b> {{ item.name }}
                            </v-chip>

                            <v-chip
                                class="col-12 text-white c-red">
                                <b class="mr-1">Project Manager: </b> {{ item.project_manager }}
                            </v-chip>

                            <v-chip
                                class="col-12 text-white c-purple">
                                <b class="mr-1">Created: </b> {{ item.create }}
                            </v-chip>

                        </v-chip-group>

                    </v-card-text>

                    <v-card-actions>
                        <v-spacer/>
                        <project-detail :project="item"/>
                    </v-card-actions>

                </v-card>

            </div>

        </div>

    </v-app>

</template>

<script>

import axios from 'axios';
import ProjectDetail from "../../admin/components/ProjectDetail";

export default {
    name: "App",
    components: {ProjectDetail},
    created() {
        this.initialize()
    },
    data: () => ({
        projects: []
    }),
    methods:
        {
            initialize() {

                axios.get(route('web_project_index')).then(response => {

                    this.projects = response.data.projects;

                }).catch(e => {
                    console.log("Error...", e)
                })
            },
        },
    watch:
        {
            de: function dialog(value) {
                console.log(value)
            },
        }
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
