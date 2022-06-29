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
        <div className="container-fluid">
            <nav className="navbar navbar-dark bg-dark">
                <div className="container-fluid">
                    <a className="navbar-brand" href="#">
                        <img src="/images/banner.png" alt="" height={30} />
                    </a>
                    <div className="navbar-expand" id="navbarScroll">
                        <ul className="navbar-nav ms-auto my-2 my-lg-0">
                            <li className="nav-item me-2">
                                <a className="nav-link active" aria-current="page" href="/">
                                    Dashboard
                                </a>
                            </li>
                            <a href="/create-user" className="btn btn-primary me-2">
                                Register
                            </a>
                            {
                                user
                                    ? (<button onClick={handleLogout} className="btn btn-danger">
                                        Logout
                                    </button>)
                                    : (<a href="/login" className="btn btn-outline-success">Login</a>)
                            }

                        </ul>
                    </div>
                </div>
            </nav>

            <main className="py-4">
                {children}
            </main>
        </div>
    )
}

export default Layout
