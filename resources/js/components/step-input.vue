<template>
    <div class="card">
        <div class="card-header">
            <div>
                <label v-if="!newStep">要完成当前任务，需要哪些步骤？</label>
                <input type="text" v-model="newStep"  ref="newStep"  @keyup.enter="addStep" >
            </div>

            <button class="btn btn-sm btn-success mt-3 float-right" v-if="newStep" @click="addStep">添加步骤</button>
        </div>
    </div>
</template>

<script>
import 'element-ui/lib/theme-chalk/index.css';
import { Message } from 'element-ui';
// import { Hub } from '../event-bus'
export default {
    props: {
        route: String
    },
    data() {
        return {
            newStep: ''
        }
    },
    // created() {
    //     Hub.$on('edit', this.edit)
    // },
    methods: {
        addStep() {
            axios.post(this.route, { name: this.newStep }).then((res)=>{
                // this.$emit('add', {id:res.data.step.id, name:res.data.step.name, completion:false})
                // this.newStep = ''
                //方法二 this.fetchSteps()
                window.location.reload()
            }).catch((err)=>{
                if(err.response.status === 422) {
                    Message.error(err.response.data.errors.name[0])
                }
            })
        }
        // edit(step) {
        //     this.newStep = step.name
        //     this.$refs.newStep.focus()
        // }
    }
}
</script>