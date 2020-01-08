<template>
    <div class="instant-search">
        <form class="form-inline">
            <div class="input-group">

                <input type="text" v-model="searchStr" @focus="fetch" @blur="leave" class="form-control" placeholder="--实时任务检索--" aria-label="search" aria-describedby="basic-addon1">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-btn fa-search"></i></span>
                </div>
            </div>
        </form>

        <ul class="list-group search-list" v-if="show">
            <li class="list-group-item" v-for="task in filtered">
                <a :href="url(task)">{{ task.name }}</a>
            </li>
        </ul>
    </div>

</template>

<script>
    import 'element-ui/lib/theme-chalk/index.css';
    import { Loading } from 'element-ui';
    export default {
        data() {
          return {
              tasks: [],
              show: false,
              loaded: false,
              searchStr: ''
          }
        },
        created() {
            this.verify()
        },
        computed: {
          filtered() {
              let str = this.searchStr.trim()
              return this.tasks.filter((task)=>{
                  if(task.name.indexOf(str) !== -1) {
                      return true
                  }
              })
          }
        },
        methods: {
            verify() {
                let api_token = document.head.querySelector('meta[name="api-token"]');
                if(api_token) {
                    window.axios.defaults.headers.common['Authorization'] = api_token.content;
                }
            },
            fetch() {
                if(!this.loaded) {
                    let loading = Loading.service({ target: '.instant-search', spinner: 'el-icon-loading' })
                    axios.get('/api/tasks/search').then((res)=>{
                        this.tasks = res.data.tasks
                        this.show = true
                        this.loaded = true
                        loading.close()
                    })
                } else {
                    this.show = true
                }
            },
            leave() {
                setTimeout(()=>{
                    this.show = false
                },2000)
            },
            url(task) {
                return `/tasks/${ task.id }`
            }
        }
    }
</script>

<style>
    .instant-search {
        height: 3rem;
        z-index: 1000;
    }

    .search-list{
        max-height: 30rem;
        overflow: auto;
    }
</style>
