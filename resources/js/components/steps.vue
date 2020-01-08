<template>
    <div class="row justify-content-center">
        <div class="col-4 mr-3">
            <step-list :steps="todos" :route="route">
<!--            <step-list :steps="todos" :route="route" @remove="remove">    -->
                <div class="card-header">
                    待完成的步骤:（{{ todos.length }}）
                    <button class="btn btn-sm btn-success float-right" @click="completeAll">完成所有</button>
                </div>
            </step-list>
            <step-input :route="route" ></step-input>
        </div>

        <div class="col-4">
            <step-list :steps="dones" :route="route" >
<!--            <step-list :steps="dones" :route="route" @remove="remove">-->
                <div class="card-header">
                    已完成的步骤：({{ dones.length }})
                    <button class="btn btn-sm btn-danger float-right" @click="clearCompleted">清除已完成</button>
                </div>
            </step-list>
        </div>
    </div>
</template>

<script>
    import StepInput from './step-input'
    import StepList from './step-list'
    export default {
        props: {
            route: String,
            // initialSteps: Array,
            todos: Array,
            dones: Array
        },
        components: {
          'step-input': StepInput,
          'step-list': StepList
        },
        // data() {
        //     return {
        //         steps: this.initialSteps
        //     }
        // },
        created() {
            this.fetchSteps()
            // Hub.$on('remove', this.remove)
        },
        // computed: {
        //     inProcess() {
        //         // return this.steps.filter(function(step){
        //         //     return step.completion == false
        //         // })
        //     },
        //     processed() {
        //         // return this.steps.filter(function(step){
        //         //     return step.completion == true
        //         // })
        //     }
        // },
        methods: {
            fetchSteps() {
                let api_token = document.head.querySelector('meta[name="api-token"]');

                if(api_token) {
                    window.axios.defaults.headers.common['Authorization'] = api_token.content;
                }
                // axios.get(this.route).then((res)=>{
                //     this.steps=res.data.steps
                // }).catch((err)=>{
                //     alert('很抱歉，发生错误，\n'+ err.response.data.message+'\n错误码：'+err.response.status)
                // })
            },
            // sync(step) {
            //     this.steps.push(step)
            // },
            // remove(step) {
            //         let i = this.steps.indexOf(step)
            //         this.steps.splice(i, 1)
            // },
            completeAll() {
                axios.post(`${this.route}/complete`).then((res)=>{
                    // this.inProcess.forEach((step)=>{
                    //     step.completion = true
                    // })
                    window.location.reload()
                })
            },
            clearCompleted() {
                axios.delete(`${this.route}/clear`).then((res)=>{
                    window.location.reload()
                    // this.steps = this.inProcess
                })
            }
        }
    }
</script>

<style>

</style>