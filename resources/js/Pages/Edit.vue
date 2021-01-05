<template>
    <Dashboard>
        <form @submit.prevent="submit">
            <div class="flex flex-wrap justify-between pl-3 text-sm">
                <div class="flex flex-col" :class="wrapStyle">
                    <div :class="labelStyle">Meeting Date</div>
                    <div><input type="text" :class="inputStyle" class="cursor-not-allowed" :value="$page.edit[0].meeting_date" disabled></div>
                </div>
                <div class="flex flex-col" :class="wrapStyle">
                    <div :class="labelStyle">Start Time</div>
                    <div><input type="time" :class="inputStyle" class="cursor-not-allowed" :value="$page.edit[0].s_time" disabled></div>
                </div>
                <div class="flex flex-col" :class="wrapStyle">
                    <div :class="labelStyle">End Time</div>
                    <div><input type="time" :class="inputStyle" class="cursor-not-allowed" :value="$page.edit[0].e_time" disabled></div>
                </div>
                <div class="flex flex-col" :class="wrapStyle">
                    <div :class="labelStyle">Meeting Room</div>
                    <div>
                        <select id="" :class="inputStyle" class="cursor-not-allowed" :value="$page.edit[0].room" disabled>
                            <option value="1">Room 1</option>
                            <option value="3">Room 3</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col" :class="wrapStyle">
                    <div :class="labelStyle">Meeting Title</div>
                    <div><input type="text" :class="inputStyle" v-model="title"></div>
                    <div v-if="$page.error.meeting_title" :class="errorTextStyle">{{$page.error.meeting_title[0]}}</div>
                </div>
                <div class="flex flex-col" :class="wrapStyle">
                    <div :class="labelStyle">Host</div>
                    <div><input type="text" v-model="host" :class="inputStyle"></div>
                    <div v-if="$page.error.host" :class="errorTextStyle">{{$page.error.host[0]}}</div>
                </div>
                <div class="flex flex-col" :class="wrapStyle">
                    <div :class="labelStyle">Join</div>
                    <div><input type="text" :class="inputStyle" v-model="join"></div>
                    <div v-if="$page.error.join" :class="errorTextStyle">{{$page.error.join[0]}}</div>
                </div>
                <div class="flex flex-col" :class="wrapStyle">
                    <div :class="labelStyle">Video Conferencing?</div>
                    <div>
                        <select id="" :class="inputStyle" v-model="vc">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div v-if="$page.error.video_conferencing" :class="errorTextStyle">{{$page.error.video_conferencing[0]}}</div>
                </div>
                <div class="flex flex-col" :class="wrapStyle">
                    <div :class="labelStyle">Name</div>
                    <div><input type="text"  :class="inputStyle" v-model="name"></div>
                    <div v-if="$page.error.name" :class="errorTextStyle">{{$page.error.name[0]}}</div>
                </div>
                <div class="flex flex-col" :class="wrapStyle">
                    <div :class="labelStyle">Position</div>
                    <div><input type="text" :class="inputStyle" v-model="pos"></div>
                    <div v-if="$page.error.position" :class="errorTextStyle">{{$page.error.position[0]}}</div>
                </div>
                <div class="flex flex-col" :class="wrapStyle">
                    <div :class="labelStyle">Department</div>
                    <div><input type="text" :class="inputStyle" v-model="dept"></div>
                    <div v-if="$page.error.department" :class="errorTextStyle">{{$page.error.department[0]}}</div>
                </div>
            </div>
            <div class="flex justify-end text-sm">
                <inertia-link :href="approve" class="rounded-md focus:outline-none bg-green-500 hover:bg-green-700 text-white px-3 py-2 mr-3">Approve</inertia-link>
                <button class="rounded-md focus:outline-none bg-blue-500 hover:bg-blue-700 text-white px-3 py-2 mr-3">Update</button>
                <inertia-link :href="del" class="rounded-md focus:outline-none bg-red-500 hover:bg-red-700 text-white px-3 py-2 mr-3">Delete</inertia-link>
            </div>
            <Alert/>
        </form>
    </Dashboard>
</template>

<script>
import JetDialogModal from '@/Jetstream/DialogModal'
import Alert from './Alert'
import Dashboard from './Dashboard'
export default {
    name: 'Edit',
    props: {
        edit: {}
    },
    components: {
        JetDialogModal,
        Dashboard,
        Alert
    },
    data() {
        return {
            test: '',
            errorTextStyle: 'text-xs text-red-500 mt-1 font-semibold',
            wrapStyle: 'mr-4 my-3',
            labelStyle: 'mb-1 ml-1',
            inputStyle: 'border p-2 w-80 sm:w-44 rounded-md focus:outline-none focus:border-gray-500 focus:bg-white',
            vc: '',
            title: '',
            host: '',
            join: '',
            name: '',
            pos: '',
            dept: '',
            approve: '',
            id: '',
            del: ''
        }
    },
    created() {
        this.approve = '/check-approve/'+this.edit[0].id
        this.del = '/delete/'+this.edit[0].id
        this.title = this.edit[0].title
        this.vc = this.edit[0].vc
        this.host = this.edit[0].host
        this.join = this.edit[0].join
        this.name = this.edit[0].name
        this.pos = this.edit[0].pos
        this.dept = this.edit[0].dept
        this.id = this.edit[0].id
    },
    methods: {
        submit() {
            let Data = new FormData()
            Data.append('vc' , this.vc)
            Data.append('title' , this.title)
            Data.append('host' , this.host)
            Data.append('join' , this.join)
            Data.append('name' , this.name)
            Data.append('pos' , this.pos)
            Data.append('dept' , this.dept)
            this.$inertia.post('/edit/'+this.id , Data)
        },
    },
}
</script>