import React from 'react'
import {Inertia} from "@inertiajs/inertia";
import {usePage} from "@inertiajs/inertia-react";

const Layout = ({ children }) => {
    const { auth: { user } } = usePage().props

    console.log(user)

    const handleLogout = () => {
        Inertia.post('/logout')
    }

    return (
        <div className="container-fluid p-0">
            <nav className="navbar navbar-expand-lg navbar-light bg-light shadow">
                <div className="container-fluid px-4">
                    <a className="navbar-brand" href="#">
                        <img src="/images/banner.png" alt="" height={30} />
                    </a>

                    <button className="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span className="navbar-toggler-icon"></span>
                    </button>

                    <div className="collapse navbar-collapse" id="navbarNav">
                        <ul className="navbar-nav me-auto my-2 my-lg-0">
                            <li className="nav-item">
                                <a className="nav-link" aria-current="page" href="/">
                                    Dashboard
                                </a>
                            </li>
                            <li className="nav-item">
                                <a href="/create-user" className="nav-link">
                                    Create User
                                </a>
                            </li>
                        </ul>
                    </div>

                    {
                        user
                            ? (<button onClick={handleLogout} className="btn btn-danger">
                                Logout
                            </button>)
                            : (<a href="/login" className="btn btn-success">Login</a>)
                    }
                </div>
            </nav>

            <main className=" px-4 py-4">
                {children}
            </main>
        </div>
    )
}

export default Layout
