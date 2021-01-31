<template>
    <div>
        <h2>Jobs koko</h2>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li :class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchJobs(pagination.prev_page_url)">Previous</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="" >Page {{pagination.current_page}} of {{pagination.last_page}}</a></li>
                <li :class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchJobs(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
        <div v-if="!loaded">
            loading jobs
        </div>

        <div v-else class="card card-body mb-2" v-for="job in jobs" :key="job.id">
            <h3>{{job.title}}</h3>
            <p>{{job.body}}</p>
            <hr>
            <button class="btn btn-danger" @click="deleteJob(job.id)">Delete</button>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return{
            loaded:false,
            jobs:[],
            job:{
                id:'',
                title:'',
                body:'',
            },
            job_is:'',
            pagination:{},
            edit:false
        }
    },
    mounted() {
        setTimeout( ()=>{
            this.loaded=true
        },4000)
    },
    created(){

        this.fetchJobs();
    },
    methods:{
        fetchJobs(page_url){
            let vm=this;
            page_url=page_url || '/api/jobs'
            fetch(page_url)
            .then(res=>res.json())
            .then(res => {
                this.jobs=res.data;
                vm.makePagination(res.meta,res.links);
            })
            .catch(err=>console.log(err));
        },
        makePagination(meta,links){
            let pagination={
                current_page:meta.current_page,
                last_page:meta.last_page,
                next_page_url:links.next,
                prev_page_url:links.prev
            }

            this.pagination=pagination;
        },
        deleteJob(id){
            if(confirm('Are you sure?')){
                fetch(`api/job/${id}`,{
                    method:'delete'
                })
                .then(res =>res.json())
                .then(data=>{
                    alert('Job removed');
                    this.fetchJobs()
                })
                .catch(err=>console.log(err));
            }
        }
    }
}
</script>
