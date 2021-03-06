import React from 'react'
import {useForm} from "@inertiajs/inertia-react";

const LoginPage = () => {

    const { data, setData, processing, post, errors} = useForm({
        email: '',
        password: ''
    })

    const handleChange = ({ target: { name, value } }) => {
        setData({
            ...data,
            [name]: value
        })
    }

    const handleSubmit = (e) => {
        e.preventDefault()
        post('/login')
    }

    return (
        <div className="container mt-5">
            <div className="row text-center">
                <div className="col">
                    <img height={100} src="/images/banner.png" alt="Ridemap Logo" />
                </div>
            </div>

            <div className="row justify-content-center">
                <div className="col-md-6">
                    <div className="card">
                        <div className="card-header text-center">
                            Login to your Ridemap account
                        </div>
                        <div className="card-body">

                            <form onSubmit={handleSubmit}>
                                <div className="form-group row mb-3">
                                    <label className="col-sm-4 col-form-label" htmlFor="">Email</label>
                                    <div className="col-sm-8">
                                        <input
                                            className="form-control"
                                            type="email"
                                            name="email"
                                            onChange={handleChange}/>
                                        {
                                            errors.email && <div className="text-danger">{errors.email}</div>
                                        }
                                    </div>
                                </div>

                                <div className="form-group row mb-3">
                                    <label className="col-sm-4 col-form-label" htmlFor="">Password</label>
                                    <div className="col-sm-8">
                                        <input
                                            className="form-control"
                                            type="password"
                                            name="password"
                                            onChange={handleChange}/>
                                        {
                                            errors.password && <div className="text-danger">{errors.password}</div>
                                        }
                                    </div>
                                </div>

                                <div className="form-group row">
                                    <div className="col-sm-8 offset-sm-4">
                                        <button disabled={processing} type="submit" className="btn btn-primary">
                                            {
                                                processing ? 'Processing...' : 'Submit'
                                            }
                                        </button>

                                        <a href="/" className="ms-2">
                                            Back to Dashboard
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default LoginPage
