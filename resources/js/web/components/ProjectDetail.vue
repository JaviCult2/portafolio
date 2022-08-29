<template>

    <div class="text-center">

        <v-dialog v-model="dialog" max-width="600" persistent>

            <template v-slot:activator="{ on, attrs }">

                <v-btn
                    color="#34495E"
                    rounded
                    dark
                    v-bind="attrs"
                    v-on="on"
                    x-small
                >
                    <v-icon dark x-small>mdi-eye</v-icon>
                    <div v-if="version==='v1'" class="ml-2">
                        Show more
                    </div>
                </v-btn>
            </template>

            <v-card class="c-blue">

                <v-card-title>
                    <h2 class="text-white">{{ this.project.name }}</h2>
                </v-card-title>

                <v-card-text>

                    <v-stepper v-model="e6" vertical>

                        <v-stepper-step step="1" @click="e6 = 1" color="#4D4D81">
                            Detail
                        </v-stepper-step>

                        <v-stepper-content step="1">
                            <v-card color="" class="p-3">
                                <p class="text-black">Name: <br> <b class="c-red">{{ project.name }}</b></p>
                                <p class="text-black">Project Manager: <br>
                                    <b class="c-red">{{ project.project_manager }}</b>
                                </p>
                                <p class="text-black">Created: <br> <b class="c-red">{{ project.create }}</b></p>
                            </v-card>
                        </v-stepper-content>

                        <v-stepper-step step="2" @click="e6 = 2" color="#4D4D81">
                            Description
                        </v-stepper-step>

                        <v-stepper-content step="2">
                            <v-card class="p-3">
                                <p class="text-black">{{ project.description }}</p>
                            </v-card>
                        </v-stepper-content>

                        <v-stepper-step step="2" @click="e6 = 3" color="#4D4D81">
                            Developers
                        </v-stepper-step>

                        <v-stepper-content step="3">
                            <v-card class="p-3">
                                <div v-for="(item,index) of project.developers" :key="index">
                                    <p class="text-black">
                                        <v-icon
                                            color="#4D4D81">
                                            mdi-account-circle
                                        </v-icon>
                                        <b class="c-red">
                                            {{ item.name }} {{ item.last_name }}</b>
                                    </p>
                                    <hr>
                                </div>
                            </v-card>
                        </v-stepper-content>

                    </v-stepper>

                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="#fff"
                        text
                        @click="dialog = false"
                    >
                        Close
                    </v-btn>
                </v-card-actions>
            </v-card>

        </v-dialog>

    </div>

</template>

<script>
export default {
    name: "ProjectDetail",
    props:
        {
            version: {value: String, default: 'v1'},
            project: {
                required: true,
                default: {}
            }
        },
    data: () => ({
        dialog: false,
        e6: 1,
    })
}
</script>

<style scoped>

.c-blue {
    background-color: #4D4D81 !important;
}

.c-red {
    color: #C70039;
}

@media (min-width: 575px) {
    p br {
        display: none;
    }
}

</style>
