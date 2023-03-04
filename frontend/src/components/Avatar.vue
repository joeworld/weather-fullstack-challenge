<template>
    <div v-bind:style="{ backgroundColor: getRandomColor() }" class="avatar-icon">
        <span class="white--text">{{ getInitials(initials) }}</span>
    </div>
</template>

<script lang="ts">
    export default {
        name: "Avatar",
        props: ["initials"],
        data: function () {
            return {
                colors: [
                    "#F44336",
                    "#E91E63",
                    "#9C27B0",
                    "#673AB7",
                    "#3F51B5",
                    "#2196F3",
                    "#03A9F4",
                    "#00BCD4",
                    "#009688",
                    "#4CAF50",
                    "#8BC34A",
                    "#FF9800",
                    "#FF5722",
                ],
            };
        },
        methods: {
            getInitials(data) {
                if (data != null) {
                    let chr;
                    const d = data.toUpperCase();
                    chr = d.split(" ");
                    if (chr.length >= 2) {
                        return chr[0][0] + chr[1][0];
                    } else {
                        return d[0] + d[1];
                    }
                }
                return "";
            },
            getRandomColor() {
                let randomIndex = Math.floor(Math.random() * this.colors.length);
                return this.colors[randomIndex];
            },
        },
    };
</script>

<style scoped>
    .avatar-icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        text-align: center;
        line-height: 2.4;
        color: #ffffff;
        font-weight: bold;
        border-radius: 50%;
    }
</style>
