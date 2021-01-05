<template>
    <div class="flex flex-row">
        <!-- sidebar -->
        <div class="sidebar w-14 md:w-72">
            <div class="bg-green-900 h-screen">
                <div class="text-center py-3 text-xl font-bold text-white bg-gray-800">
                    <span class="hidden md:block">SweetyHome</span>
                    <span class="block md:hidden">SH</span>
                </div>
                <div class="flex flex-col" :class="flexColStyle">
                    <div :class="childFlexColStyle">
                        <inertia-link href="/" :class="linkStyle"><i class="fas fa-tachometer-alt " :class="iconStyle" title="Dashboard"></i><span :class="linkTextStyle">Dashboard</span></inertia-link>
                    </div>
                    <div :class="childFlexColStyle">
                        <inertia-link href="/meeting-request-form" :class="linkStyle"><i class="far fa-edit" :class="iconStyle" title="Meeting Request Form"></i><span :class="linkTextStyle">Meeting Request Form</span></inertia-link>
                    </div>
                    <div :class="childFlexColStyle">
                        <inertia-link href="" :class="linkStyle"><i class="far fa-comment-alt" :class="iconStyle" title="Chat"></i><span :class="linkTextStyle">Chat</span></inertia-link>
                    </div>
                    <div :class="childFlexColStyle">
                        <inertia-link href="" :class="linkStyle"><i class="fas fa-star-half-alt" :class="iconStyle" title="Feedback"></i><span :class="linkTextStyle">Feedback</span></inertia-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full">
            <div class="flex flex-col">
                <!-- navbar -->
                <div class="flex justify-between px-4 p-3 border-b border-gray-300 shadow-sm">
                    <div>
                        <i class="fas fa-bars text-lg mr-3"></i><span class="text-lg">{{$page.title}}</span>
                    </div>
                    <div>
                        <div class="inline-block">
                            <jet-dropdown width="64">
                                <template #trigger>
                                    <button class="items-center text-gray-500  hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <span class="mr-1 text-red-500 text-xs">{{noti.length}}</span><i class="far fa-bell mr-2 text-red-500"></i>
                                    </button>
                                </template>
                            <template #content>
                                <div v-for="(data,index) in noti" :key="index" class="text-sm">
                                    <div class="py-2 pl-3 border-b border-gray-300 bg-gray-100 hover:bg-white"><span class="text-blue-500">{{data.data.name}}</span><span class="ml-1">is schedule a meeting.</span>
                                        <div class="text-xs italic text-gray-500">{{moment}}</div>
                                    </div>
                                </div>
                            </template>
                            </jet-dropdown>
                        </div>
                        <div class="inline-block"><i class="far fa-user-circle mr-1 text-gray-500"></i></div>
                        <jet-dropdown width="48">
                            <template #trigger>
                                <button class="flex items-center text-sm font-medium text-gray-500  hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div class="">{{ $page.user.name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </template>

                            <template #content>
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Account
                                </div>

                                <jet-dropdown-link :href="route('profile.show')">
                                    Profile
                                </jet-dropdown-link>

                                <div class="border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form @submit.prevent="logout">
                                    <jet-dropdown-link as="button">
                                        Logout
                                    </jet-dropdown-link>
                                </form>
                            </template>
                        </jet-dropdown>
                    </div>
                </div>
                <!-- content -->
                <div class="bg-gray-50 mt-1 p-3">
                    <main>
                        <slot/>
                    </main>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
    import moment from 'moment'

    export default {
        components: {
            JetApplicationMark,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
        },
        props: {
            user: {},
        },
        data() {
            return {
                noti: '',
                moment: '',
                showingNavigationDropdown: false,
                flexColStyle: 'mt-12 mb-3',
                childFlexColStyle: 'my-2 ml-3 text-gray-300',
                linkStyle: 'hover:no-underline hover:text-gray-100 ',
                iconStyle: 'mr-2',
                linkTextStyle: 'hidden md:inline-block'
            }
        },
        created() {
            window.Echo.private('App.Models.User.' + this.$page.user.id)
            .notification((notification) => {
                alertify.set('notifier','position', 'top-right');
                alertify.success(notification.name + ' is schedule a meeting.');
            });
            axios.get("/get_noti").then((res) => {
                    this.noti = res.data;
                    // console.log(res);
            });
            this.moment = moment('01-04-2021 7:00:00 am').startOf('hour').fromNow(); 
        },
        methods: {
            logout() {
                axios.post(route('logout').url()).then(response => {
                    window.location = '/';
                })
            },
        }
    }
</script>
