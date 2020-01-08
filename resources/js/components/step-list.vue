<template>
    <div class="card mb-4" v-if="steps.length">
        <slot></slot>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item" v-for="(step, index) in steps">
                    <span @dblclick="edit(step, index)" ref="stepName">{{ step.name }}</span>
                    <input type="text" v-model="editedStep" @keyup.enter="update(step)"  ref="stepInput"
                           style="display:none" class="form-control">
                    <span class="float-right">
                                    <i class="fa fa-check" @click="toggle(step)"></i>
                                     <i class="fa fa-times" @click="remove(step)"></i>
                                </span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    // import { Hub } from '../event-bus'
    export default {
        props: {
            steps: Array,
            route: String
        },
        data() {
          return {
              editedStep: ''
          }
        },
        methods: {
            toggle(step) {
                axios.patch(`${this.route}/${step.id}/toggle`, {completion: !step.completion}).then((res)=>{
                    window.location.reload()
                    // step.completion = !step.completion
                    // this.$emit('toggle', step)
                    // console.log(this.steps)
                })
            },
            remove(step) {
                axios.delete(`${this.route}/${step.id}`).then((res)=>{
                    window.location.reload()
                    // this.$emit('remove', step)
                })
            },
            edit(step, index) {
                this.$refs.stepName[index].style.display = 'none'
                this.$refs.stepInput[index].style.display = 'block'
                this.editedStep = step.name
                // //删除当前step
                // this.remove(step)
                // //在当前输入框中显示step的name
                // Hub.$emit('edit', step)
                // // this.newStep = step.name
                // //focus当前输入框
            },
            update(step) {
                axios.patch(`${this.route}/${step.id}`, {name: this.editedStep}).then((res)=>{
                    window.location.reload()
                })
            }
        }
    }
</script>