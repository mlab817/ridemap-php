import React from 'react'
import { useForm } from '@inertiajs/inertia-react'
import Layout from "../components/Layout";


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
        <Layout>
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">
                            Create New User
                        </div>
                        <div className="card-body">
                            <form onSubmit={handleSubmit} onReset={handleReset}>

                                {
                                    flash.message && <div className="alert alert-success" role="alert">{flash.message}</div>
                                }

                                <div className="form-group row mb-3">
                                    <label htmlFor="name" className="col-md-4 col-form-label">Name</label>
                                    <div className="col-md-8">
                                        <input className="form-control" value={data.name} id="name" placeholder="Juan dela Cruz" name="name" type="text" onChange={handleOnChange} />
                                        {errors.name && <div className="text-danger">
                                            <small>{errors.name}</small></div>}
                                    </div>
                                </div>

                                <div className="form-group row mb-3">
                                    <label htmlFor="email" className="col-md-4 col-form-label">Email Address</label>
                                    <div className="col-md-8">
                                        <input className="form-control" value={data.email} id="email" placeholder="user@domain.com" name="email" type="text" onChange={handleOnChange} />
                                        {errors.email && <div className="text-danger">
                                            <small>{errors.email}</small></div>}
                                    </div>
                                </div>

                                <div className="form-group row mb-3">
                                    <label htmlFor="password" className="col-md-4 col-form-label">Password</label>
                                    <div className="col-md-8">
                                        <input className="form-control" value={data.password} placeholder="********" name="password" type="password" onChange={handleOnChange}/>
                                        {errors.password && <div className="text-danger">
                                            <small>{errors.password}</small></div>}
                                    </div>
                                </div>

                                <div className="form-group row mb-3">
                                    <label htmlFor="device_id" className="col-md-4 col-form-label">Device ID</label>
                                    <div className="col-md-8">
                                        <input className="form-control" value={data.device_id} placeholder="Device ID" name="device_id" type="text" onChange={handleOnChange}/>
                                        {errors.device_id && <div className="text-danger">
                                            <small>{errors.device_id}</small></div>}
                                    </div>
                                </div>

                                <div className="form-group row">
                                    <div className="col-md-8 offset-md-4">
                                        <button type="submit" disabled={processing} className="btn btn-block btn-primary">Submit</button>
                                        <button type="reset" disabled={processing} className="btn btn-block btn-danger ms-2">Reset</button>

                                        <a href="/" className="ms-3">Dashboard</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </Layout>
    )
}

export default RegisterPage
