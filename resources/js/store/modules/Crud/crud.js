export default {
    namespaced: true,

    state:
    {
        ModalObj : {
            apiUrl : '',
            data : null,
            toastSuccess: '',
            toastError: ''
        },

    },

    getters:
    {
        getModalObj(state){
            return state.ModalObj
        }
    },

    mutations: 
    {
        setAddModal(state){
            axios.post(state.ModalObj.apiUrl ,state.ModalObj.data)
            .then(response => {
            toast.fire({
                icon: 'success',
                title: state.ModalObj.toastSuccess
            })
            })
            .catch(
                toast.fire({
                    icon: 'error',
                    title: state.ModalObj.toastError
            }))
        },

        setUpdateModal(state){
            axios.put(state.ModalObj.apiUrl,state.ModalObj.data).then((response) =>{
                toast.fire({
                    icon: 'success',
                    title: state.ModalObj.toastSuccess
                })
            }).catch(
                toast.fire({
                    icon: 'error',
                    title: state.ModalObj.toastError
            }))
        },

        setDeleteModal(state){
            axios.delete(state.ModalObj.apiUrl,state.ModalObj.data).then((response) =>{
                toast.fire({
                    icon: 'success',
                    title: state.ModalObj.toastSuccess
                })
            }).catch(error => console.log(error))
        },
    
    },

    actions: {},

  };
