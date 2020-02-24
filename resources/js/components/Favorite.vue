<template>
    <button type="submit" :class="classes" @click="toggle">
        <i class="fas fa-heart-o"></i>
        <span v-text="count"></span>
    </button>

</template>

<script>
    export default {
        props: ['reply'],
        data() {
            return {
                count: this.reply.favoritesCount,
                active: this.reply.isFavorited
            }
        },
        computed: {
            classes() {
                return ['btn', this.active ? 'btn-primary' : 'btn-link'];
            },
            endpoint(){
                return '/replies/' + this.reply.id + '/favorite';
            }
        },
        methods: {
            toggle() {
                this.active ? this.create() : this.destroy() ;
            },
            create() {
                axios.delete(this.endpoint);
                this.count--;
                this.active = false;
            },
            destroy() {
                axios.post(this.endpoint);
                this.count++;
                this.active = true;
            }
        }
    }
</script>

