<template>

    <v-app class="bg-principal">

        <div class="container bg-container">

            <v-data-table
                :headers="headers"
                :items="projects"
                sort-by="name"
                class="elevation-1"
            >
                <template v-slot:top>

                    <v-toolbar flat class="bg-toolbar">

                        <v-toolbar-title class="text-white"><b>My Projects</b></v-toolbar-title>

                        <v-divider class="mx-4" inset vertical></v-divider>

                        <v-spacer></v-spacer>

                        <v-dialog v-model="dialog" max-width="500px">

                            <template v-slot:activator="{ on, attrs }">
                                <v-btn
                                    v-bind="attrs"
                                    v-on="on"

                                    class="mb-2"
                                    color="#fff"
                                >
                                    + Add
                                </v-btn>
                            </template>

                            <v-card>

                                <div class="p-3" style="background: #4D4D81">
                                    <h5 class="text-white"><b> {{ formTitle }} </b></h5>
                                </div>

                                <v-card-text>

                                    <v-container>

                                        <v-form v-model="valid" ref="form" class="mt-3">

                                            <v-text-field
                                                label="Name"
                                                v-model="editedItem.name"
                                                :rules="rules.name"
                                                required
                                                dense
                                                solo
                                            ></v-text-field>

                                            <v-text-field
                                                label="Project Manager"
                                                v-model="editedItem.project_manager"
                                                :rules="rules.manager"
                                                required
                                                dense
                                                solo
                                            ></v-text-field>

                                            <v-textarea
                                                label="Description"
                                                v-model="editedItem.description"
                                                :rules="rules.description"
                                                required
                                                dense
                                                solo
                                            ></v-textarea>

                                            <v-text-field
                                                label="Enterprise"
                                                v-model="editedItem.enterprise"
                                                :rules="rules.enterprise"
                                                required
                                                dense
                                                solo
                                            ></v-text-field>

                                            <v-row>
                                                <v-col cols="5">
                                                    <v-text-field v-model="developer.name"
                                                                  label="Name"
                                                                  required
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="5">
                                                    <v-text-field v-model="developer.last_name"
                                                                  label="Last Name"
                                                                  required
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="1" class="add">
                                                    <v-icon
                                                        v-on:click="addDeveloper"
                                                        large
                                                        color="#4980D0">
                                                        mdi-plus-circle-outline
                                                    </v-icon>
                                                </v-col>
                                            </v-row>

                                            <v-row v-for="(item, index) of editedItem.developers" :key="index">

                                                <v-col cols="5" class="productItem">
                                                    {{ item.name }}
                                                </v-col>
                                                <v-col cols="5" class="productItem">
                                                    {{ item.last_name }}
                                                </v-col>
                                                <v-col cols="1" class="productItem less">
                                                    <v-icon
                                                        v-on:click="removeDev(index)"
                                                        large
                                                        color="#4980D0">
                                                        mdi-close
                                                    </v-icon>
                                                </v-col>

                                            </v-row>

                                        </v-form>

                                    </v-container>

                                </v-card-text>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        dark
                                        color="#4D4D81"
                                        @click="close"
                                    >
                                        Cancel
                                    </v-btn>
                                    <v-btn
                                        dark
                                        color="#4D4D81"
                                        @click="save"
                                    >
                                        Save
                                    </v-btn>
                                </v-card-actions>

                            </v-card>

                        </v-dialog>

                        <v-dialog v-model="dialogDelete" max-width="500px">
                            <v-card>
                                <v-card-title class="text-h5">Are you sure ?
                                </v-card-title>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="#4D4D81" dark @click="closeDelete">Cancel</v-btn>
                                    <v-btn color="#4D4D81" dark @click="deleteItemConfirm">OK</v-btn>
                                    <v-spacer></v-spacer>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>

                    </v-toolbar>
                </template>
                <template v-slot:item.actions="{ item }">
                    <v-icon
                        color="#2E4053"
                        @click="editItem(item)"
                    >
                        mdi-pencil
                    </v-icon>
                    <v-icon
                        color="#C70039"
                        @click="deleteItem(item)"
                    >
                        mdi-delete
                    </v-icon>
                    <v-switch
                        v-model="item.active"
                        @click="active(item.id)"
                    ></v-switch>
                </template>
            </v-data-table>

        </div>

    </v-app>

</template>

<script>

import axios from "axios";

export default {
    name: "App",
    computed:
        {
            formTitle() {
                return this.editedIndex === -1 ? 'New Project' : 'Edit Project'
            },
        },
    created() {
        this.initialize()
    },
    data: () =>
        ({
            project: 'Admin',
            year: new Date().getFullYear(),

            valid: false,
            loading: false,
            dialog: false,
            dialogDelete: false,

            headers: [
                {
                    text: 'Name',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                {text: 'Project Manager', value: 'project_manager'},
                {text: 'Description', value: 'description'},
                {text: 'Enterprise', value: 'enterprise'},
                {text: 'Actions', value: 'actions', sortable: false},
            ],

            projects: [],

            developer: {name: '', last_name: ''},

            rules:
                {
                    name: [v => !!v || 'The name is required'],
                    manager: [v => !!v || 'The project manager is required'],
                    description: [v => !!v || 'The description is required'],
                    enterprise: [v => !!v || 'The enterprise is required'],
                    developers: [v => !!v || 'The developers is/are required'],
                },

            editedIndex: -1,
            editedItem: {
                id: '',
                name: '',
                project_manager: '',
                description: '',
                enterprise: '',
                active: true,
                developers: [],
            },
            defaultItem: {
                id: '',
                name: '',
                project_manager: '',
                description: '',
                enterprise: '',
                active: true,
                developers: [],
            },
        }),
    methods: {

        addDeveloper() {

            if (this.developer.name !== '' && this.developer.last_name !== '') {

                const dev =
                    {
                        name: this.developer.name,
                        last_name: this.developer.last_name
                    }

                this.editedItem.developers.push(dev);

                this.developer.name = ''
                this.developer.last_name = ''

            } else {

                this.$emit('showMessage', 1, 'The name and the last name are required');

            }
        },
        removeDev(index) {
            this.editedItem.developers.splice(index, 1);
        },

        initialize() {

            axios.get(route('admin_project_index')).then(response => {

                this.projects = response.data.projects;

            }).catch(e => {
                console.log("Error...", e)
            })
        },

        create() {
            this.loading = true;

            axios.post(route('admin_project_create', this.editedItem)).then(response => {

                this.editedItem.developers = []
                this.$refs.form.reset();

            }).catch(e => {
                console.log("Error...")
            })

            this.loading = false;
        },

        update() {

            this.loading = true;

            console.log("ass", this.editedItem)

            axios.post(route('admin_project_update', this.editedItem)).then(response => {

                console.log("Data:", response)

            }).catch(e => {
                console.log("Error...")
            })

            this.loading = false;
        },

        delete() {

            this.loading = true;

            axios.post(route('admin_project_delete', {id: this.editedItem.id})).then(response => {

                console.log("Data:", response)

            }).catch(e => {
                console.log("Error...")
            })

            this.loading = false;
        },

        active(id) {

            this.loading = true;

            axios.get(route('admin_project_active', {id: id})).then(response => {

                console.log("Data:", response)

            }).catch(e => {
                console.log("Error...")
            })

            this.loading = false;
        },

        editItem(item) {
            this.editedIndex = this.projects.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem(item) {
            this.editedIndex = this.projects.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            this.projects.splice(this.editedIndex, 1)
            this.closeDelete()
            this.delete()
        },

        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        save() {

            if (this.$refs.form.validate()) {
                if (this.editedIndex > -1) {
                    Object.assign(this.projects[this.editedIndex], this.editedItem)
                    this.update()
                } else {
                    this.projects.push(this.editedItem)
                    this.create();
                }
                this.close()
            }
        },
    },
    watch: {
        dialog(val) {
            val || this.close()
        },
        dialogDelete(val) {
            val || this.closeDelete()
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
    background: #4D4D81
}

.bg-toolbar {
    background: #2d3748 !important;
}

</style>
