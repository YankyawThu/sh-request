<template>
    <jet-form-section @submitted="register">
        <template #title>
            Register
        </template>

        <template #description>
            Create a new user.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="Name" value="Name" />
                <jet-input  type="text" class="mt-1 block w-full" v-model="form.name"/>
                <!-- <jet-input-error :message="$page.error['name']" class="mt-2" /> -->
                <div v-if="$page.error.name" class="text-red-500">{{$page.error.name[0]}}</div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="email" value="Email" />
                <jet-input  type="email" class="mt-1 block w-full" v-model="form.email" autocomplete />
                <!-- <jet-input-error :message="$page.error['email']" class="mt-2" /> -->
                <div v-if="$page.error.email" class="text-red-500">{{$page.error.email[0]}}</div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="role" value="Role" />
                <!-- <jet-input type="Role" class="mt-1 block w-full" v-model="form.email" autocomplete /> -->
                <!-- <jet-input-error :message="$page.error['email']" class="mt-2" /> -->
                <select name="" id="" class="mt-1 block w-full border py-2 pl-2 focus:outline-none  rounded-md shadow-sm" v-model="form.role">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <div v-if="$page.error.role" class="text-red-500">{{$page.error.role[0]}}</div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="password" value="Password" />
                <jet-input type="password" class="mt-1 block w-full" v-model="form.password" autocomplete />
                <!-- <jet-input-error :message="$page.error['password']" class="mt-2" /> -->
                <div v-if="$page.error.password" class="text-red-500">{{$page.error.password[0]}}</div>
            </div>

            <!-- <div class="col-span-6 sm:col-span-4">
                <jet-label for="password_confirmation" value="Confirm Password" />
                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" autocomplete="new-password" />
                <jet-input-error :message="form.error('password_confirmation')" class="mt-2" />
            </div> -->
        </template>

        <template #actions>
            <!-- <jet-action-message :on="form.recentlySuccessful" class="mr-3"> -->
                <Alert/>
            <!-- </jet-action-message> -->
            <jet-button>
                Create
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import Alert from '../Alert'
export default {
    name: 'Register',
    components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            Alert
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                    role: '',
                    // password_confirmation: '',
                }, {
                    bag: '',
                }),
            }
        },
        methods: {
            register() {
                // this.form.put(route('user-password.update'), {
                //     preserveScroll: true
                // }).then(() => {
                //     this.$refs.current_password.focus()
                // })
                let Data = new FormData()   
                Data.append('name' , this.form.name)
                Data.append('email' , this.form.email)
                Data.append('password' , this.form.password)
                Data.append('role' , this.form.role)
                // Data.append('password_confirmation' , this.form.password_confirmation)
                this.$inertia.post('/create-user' , Data)
            },
        },
}
</script>

