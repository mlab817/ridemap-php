import React from 'react'
import { useForm } from '@inertiajs/inertia-react'


const RegisterPage = ({ flash }) => {
    const { data, setData, post, processing, reset, errors } = useForm({
        name: '',
        email: '',
        password: '',
        device_id: ''
    })

    const handleOnChange = ({ target: { name, value } }) => {
        setData({
            ...data,
            [name]: value
        })
    }

    const handleReset = () => reset('name','email','password','device_id')

    const handleSubmit = (e) => {
        e.preventDefault()

        post('/register', {
            preserveScroll: true,
            onSuccess: () => reset('name','email','password','device_id')
        })
    }

    return (
        <div className="container-fluid">
            <div className="row text-center mt-5">
                <h1>Register New User</h1>
            </div>

            <div className="row justify-content-center mt-5">
                <form onSubmit={handleSubmit} onReset={handleReset} className="col-xl-6">

                    {
                        flash.message && <div className="alert alert-success" role="alert">{flash.message}</div>
                    }

                    <div className="mb-3">
                        <label htmlFor="name" className="form-label">Name</label>
                        <input className="form-control" value={data.name} id="name" placeholder="Juan dela Cruz" name="name" type="text" onChange={handleOnChange} />
                        {errors.name && <div className="text-danger">
                            <small>{errors.name}</small></div>}
                    </div>

                    <div className="mb-3">
                        <label htmlFor="email" className="form-label">Email Address</label>
                        <input className="form-control" value={data.email} id="email" placeholder="user@domain.com" name="email" type="text" onChange={handleOnChange} />
                        {errors.email && <div className="text-danger">
                            <small>{errors.email}</small></div>}
                    </div>

                    <div className="mb-3">
                        <label htmlFor="password" className="form-label">Password</label>
                        <input className="form-control" value={data.password} placeholder="********" name="password" type="password" onChange={handleOnChange}/>
                        {errors.password && <div className="text-danger">
                            <small>{errors.password}</small></div>}
                    </div>

                    <div className="mb-3">
                        <label htmlFor="device_id" className="form-label">Device ID</label>
                        <input className="form-control" value={data.device_id} placeholder="Device ID" name="device_id" type="text" onChange={handleOnChange}/>
                        {errors.device_id && <div className="text-danger">
                            <small>{errors.device_id}</small></div>}
                    </div>

                    <button type="submit" disabled={processing} className="btn btn-block btn-primary">Submit</button>
                    <button type="reset" disabled={processing} className="btn btn-block btn-danger ms-2">Reset</button>

                    <a href="/" className="ms-3">Dashboard</a>
                </form>
            </div>
        </div>
    )
}

export default RegisterPage
