<template>
    <li class="py-4">
        <div class="flex items-center space-x-4">
            <div class="flex-shrink-0">
                <!--        <img class="h-8 w-8 rounded-full" src="https://png.pngtree.com/png-clipart/20210915/ourmid/pngtree-user-avatar-placeholder-png-image_3918418.jpg" alt="" />-->
                <Avatar :initials="person.name" />
            </div>
            <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-medium text-gray-900">
                    {{ person.name }}
                </p>
                <p class="truncate text-sm text-gray-500">
                    {{ person.email }}
                </p>
            </div>
            <div>
                <router-link
                        :to="`user/${person.id}`"
                        class="inline-flex items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50"
                >
                    View
                </router-link>
            </div>
        </div>
    </li>
</template>

<script setup lang="ts">
    import Avatar from "@/components/Avatar.vue";

    type Person = {
        [value: string]: string;
    };

    defineProps<{
        person: Person;
    }>();
</script>
