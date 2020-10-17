export default {
    methods: {
        getImg: function(imgName) {
            try {
                return require('@/assets/images/' + imgName)
            } catch(error) {
                return
            }
        },
    },
}
