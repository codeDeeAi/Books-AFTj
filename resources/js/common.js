import Axios from "axios"
import { mapGetters } from 'vuex'


export default {
    data() {
        return {

        }
    },
    methods: {
        async callApi(method, url, dataObj) {
            try {
                return await axios({
                    method: method,
                    url: url,
                    data: dataObj

                });
            } catch (error) {
                return error.response
            }



        },
        // Notification Api
        toast(message, type) {
            Vue.$toast.open({
                message: message,
                type: type,
                // all of other options may go here
            });
        },
        toastNoAccess() {
            Vue.$toast.open({
                message: 'You have no access to this function',
                type: 'info',
                // all of other options may go here
            });
        },
        toastFetchData() {
            Vue.$toast.open({
                message: 'Data fetched successfully',
                type: 'success',
                // all of other options may go here
            });
        },
        toastFetchDataError() {
            Vue.$toast.open({
                message: 'Error fetching Data !',
                type: 'error',
                // all of other options may go here
            });
        },


        checkUserPermission(key) {
            if (!this.userPermission) return true
            let isPermitted = false;
            for (let d of this.userPermission) {
                if (this.$route.name == d.name) {
                    if (d[key]) {
                        isPermitted = true
                        break;
                    } else {
                        break
                    }
                }

            }
            return isPermitted
        }
    },

    // CRUD Permissions
    computed: {
        ...mapGetters({
            'userPermission': 'getUserPermission'
        }),
        permitRead() {
            return this.checkUserPermission('read')
        },
        permitWrite() {
            return this.checkUserPermission('write')
        },
        permitUpdate() {
            return this.checkUserPermission('update')
        },
        permitDelete() {
            return this.checkUserPermission('delete')
        },
    },

}