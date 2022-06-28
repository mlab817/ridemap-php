import React from 'react'
import { useForm } from '@inertiajs/inertia-react'

const LoginPage = () => {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
        password: ''
    })

    const handleSubmit = (e) => {
        e.preventDefault()
        post('/login')
    }

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Login</div>

                        <div className="card-body">
                            <form method="POST" onSubmit={handleSubmit}>

                                <div className="row mb-3">
                                    <label htmlFor="email" className="col-md-4 col-form-label text-md-end">
                                        Email Address
                                    </label>

                                    <div className="col-md-6">
                                        <input id="email" type="email"
                                           className="form-control"
                                           name="email"
                                           value={data.email}
                                           required
                                           autoComplete="email"
                                           onChange={e => setData('email', e.target.value)}
                                           autoFocus />

                                        {errors.email &&
                                            (<span className="invalid-feedback" role="alert">
                                                <strong>{errors.email}</strong>
                                            </span>)
                                        }
                                    </div>
                                </div>

                                <div className="row mb-3">
                                    <label htmlFor="password" className="col-md-4 col-form-label text-md-end">
                                        Password
                                    </label>

                                    <div className="col-md-6">
                                        <input
                                            id="password"
                                            type="password"
                                            value={data.password}
                                            className="form-control"
                                            name="password"
                                            required
                                            onChange={e => setData('password', e.target.value)}
                                            autoComplete="current-password" />

                                            {
                                                errors.password && (
                                                <span className="invalid-feedback" role="alert">
                                                    <strong>{errors.password}</strong>
                                                </span>)
                                            }
                                    </div>
                                </div>

                                <div className="row mb-0">
                                    <div className="col-md-8 offset-md-4">
                                        <button type="submit" className="btn btn-primary" disabled={processing}>
                                            Login
                                        </button>
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
