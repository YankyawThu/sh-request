<template>
    <div class="inline-block mr-3">
        <div v-if="$page.success" class="ml-2 text-green-500">
            <i class="fas fa-check-circle mr-1"></i>{{$page.success}}
        </div>
        <div v-if="$page.fail" class="ml-2 text-yellow-500">
            <i class="fas fa-exclamation-triangle mr-1"></i>{{$page.fail}}
        </div>
    </div>
</template>

<script>
export default {
    name: 'Alert',
}
</script>