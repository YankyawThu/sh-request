<template>
    <app-layout>
        <div class="flex flex-col text-sm">
            <div>
                <CheckDate/>
            </div>
            <div class="border bg-white py-3">
                <form @submit.prevent="submit">
                    <div class="flex flex-wrap justify-between px-3 pb-3">
                        <div class="flex flex-col" :class="wrapStyle">
                            <div :class="labelStyle">Meeting Date</div>
                            <div><input type="date" v-model="meeting_date" :class="inputStyle"></div>
                            <div v-if="$page.error.meeting_date" :class="errorTextStyle">{{$page.error.meeting_date[0]}}</div>
                        </div>
                        <div class="flex flex-col" :class="wrapStyle">
                            <div :class="labelStyle">Start Time</div>
                            <div><input type="time" v-model="start_time" :class="inputStyle"></div>
                            <div v-if="$page.error.start_time" :class="errorTextStyle">{{$page.error.start_time[0]}}</div>
                        </div>
                        <div class="flex flex-col" :class="wrapStyle">
                            <div :class="labelStyle">End Time</div>
                            <div><input type="time" v-model="end_time" :class="inputStyle"></div>
                            <div v-if="$page.error.end_time" :class="errorTextStyle">{{$page.error.end_time[0]}}</div>
                        </div>
                        <div class="flex flex-col" :class="wrapStyle">
                            <div :class="labelStyle">Meeting Title</div>
                            <div><input type="text" v-model="title" :class="inputStyle"></div>
                            <div v-if="$page.error.meeting_title" :class="errorTextStyle">{{$page.error.meeting_title[0]}}</div>
                        </div>
                        <div class="flex flex-col" :class="wrapStyle">
                            <div :class="labelStyle">Meeting Room</div>
                            <div>
                                <select v-model="room" id="" :class="inputStyle">
                                    <option value="1">Room 1</option>
                                    <option value="3">Room 3</option>
                                </select>
                                <div v-if="$page.error.room" :class="errorTextStyle">{{$page.error.room[0]}}</div>
                            </div>
                        </div>
                        <div class="flex flex-col" :class="wrapStyle">
                            <div :class="labelStyle">Host</div>
                            <div><input type="text" v-model="host" :class="inputStyle"></div>
                            <div v-if="$page.error.host" :class="errorTextStyle">{{$page.error.host[0]}}</div>
                        </div>
                        <div class="flex flex-col" :class="wrapStyle">
                            <div :class="labelStyle">Join</div>
                            <div><input type="text" v-model="join" :class="inputStyle"></div>
                            <div v-if="$page.error.join" :class="errorTextStyle">{{$page.error.join[0]}}</div>
                        </div>
                        <div class="flex flex-col" :class="wrapStyle">
                            <div :class="labelStyle">Video Conferencing?</div>
                            <div>
                                <select v-model="vc" id="" :class="inputStyle">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div v-if="$page.error.video_conferencing" :class="errorTextStyle">{{$page.error.video_conferencing[0]}}</div>
                        </div>
                        <div class="flex flex-col" :class="wrapStyle">
                            <div :class="labelStyle">Name</div>
                            <div><input type="text" v-model="name" :class="inputStyle"></div>
                            <div v-if="$page.error.name" :class="errorTextStyle">{{$page.error.name[0]}}</div>
                        </div>
                        <div class="flex flex-col" :class="wrapStyle">
                            <div :class="labelStyle">Position</div>
                            <div><input type="text" v-model="position" :class="inputStyle"></div>
                            <div v-if="$page.error.position" :class="errorTextStyle">{{$page.error.position[0]}}</div>
                        </div>
                        <div class="flex flex-col" :class="wrapStyle">
                            <div :class="labelStyle">Department</div>
                            <div><input type="text" v-model="department" :class="inputStyle"></div>
                            <div v-if="$page.error.department" :class="errorTextStyle">{{$page.error.department[0]}}</div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button class="rounded-md focus:ring-2 focus:ring-green-900 focus:ring-offset-2 focus:outline-none bg-green-600 text-white px-3 py-2 mr-5">SEND</button>
                    </div>
                    <Alert/>
                </form>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import CheckDate from './CheckDate'
import Alert from './Alert'
export default {
  components: { AppLayout,CheckDate,Alert },
    name: 'MeetingForm',
    data() {
        return {
            errorTextStyle: 'text-xs text-red-500 mt-1 font-semibold',
            wrapStyle: 'mr-4 my-3',
            labelStyle: 'mb-1 ml-1',
            inputStyle: 'border py-2 px-2 w-80 sm:w-44 rounded-md focus:outline-none focus:border-gray-600',
            meeting_date: '',
            start_time: '',
            end_time: '',
            title: '',
            host: '',
            join: '',
            vc: '',
            name: '',
            position: '',
            department: '',
            room: '',
        }
    },
    methods: {
        submit() {
            let data = new FormData()
            data.append('meeting_date', this.meeting_date)
            data.append('start_time', this.start_time)
            data.append('end_time', this.end_time)
            data.append('meeting_title', this.title)
            data.append('room', this.room)
            data.append('host', this.host)
            data.append('join', this.join)
            data.append('video_conferencing', this.vc)
            data.append('name', this.name)
            data.append('position', this.position)
            data.append('department', this.department)
            this.$inertia.post('/create', data)
        }
    },
}
</script>