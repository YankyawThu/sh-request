<template>
    <div class="border p-3 border-gray-300 bg-white mb-3">
        <div class="mb-3">
           Check Date
        </div>
        <div class="">
            <form @submit.prevent="submit">
                <input type="date" v-model="date" class="border-2 border-blue-300 focus:outline-none px-3 py-2 rounded-md mr-2">
                <button class="focus:bg-blue-300 focus:text-white border-2 hover:bg-blue-300 hover:text-white focus:outline-none p-2 rounded-md border-blue-300 text-blue-300"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div v-if="$page.error.date" :class="errorTextStyle">{{$page.error.date[0]}}</div>
        <div class="mt-3 shadow-md" v-if="$page.data">
            <table class="border w-full">
                <thead class="border bg-gray-200">
                    <tr>
                        <th :class="th">Meeting date</th>
                        <th :class="th">Start time</th>
                        <th :class="th">End time</th>
                        <th :class="th">Room</th>
                        <th :class="th">Name</th>
                        <th :class="th">Department</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(data,index) in $page.data" :key="index" class="hover:bg-gray-100">
                        <td :class="td">{{data.meeting_date}}</td>
                        <td :class="td">{{data.s_time}}</td>
                        <td :class="td">{{data.e_time}}</td>
                        <td :class="td">{{data.room}}</td>
                        <td :class="td">{{data.name}}</td>
                        <td :class="td">{{data.dept}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props: {},
    name: 'CheckDate',
    data() {
        return {
            errorTextStyle: 'text-xs text-red-500 mt-1 font-semibold',
            date: '',
            th: 'font-semibold py-2 text-center',
            td: 'text-center py-2',
        }
    },
    methods: {
        submit() {
            let data = new FormData()
            data.append('date',this.date)
            this.$inertia.post('/check-date', data)
        }
    },
}
</script>