<template>
    <div class="modal" tabindex="-1" role="dialog" ref="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Project</h5>
                    <button type="button" class="close" @click.prevent="closeModal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div v-if="errors" class="alert alert-danger">
                        <div v-for="(v, k) in errors" :key="k">
                            <p v-for="error in v" :key="error">
                                {{ error }}
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="project_name">Project name</label>
                        <input type="text" name="project_name" id="project_name" class="form-control" v-model="projectName" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="closeModal">Cancel</button>
                    <button type="button" class="btn btn-success" @click.prevent="submit">Save project</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        projectName: '',
        errors: null,
    }),
    methods: {
        open() {
           $(this.$refs.modal).modal('show');
        },
        closeModal() {
            $(this.$refs.modal).modal('hide');
            this.projectName = '';
        },
        submit() {
            axios.post('/projects/add', {
                name: this.projectName
            });
            $(this.$refs.modal).modal('hide');
        }
    }
}
</script>
