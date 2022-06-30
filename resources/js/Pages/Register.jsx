import React, {useRef} from 'react'
import { useForm } from '@inertiajs/inertia-react'
import jsQR from "jsqr";
import { Html5Qrcode } from 'html5-qrcode'

import Layout from "../components/Layout";


const RegisterPage = ({ flash }) => {
    const imageUpload = useRef(null)

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

    const scanQr = () => {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                console.log(stream)
            }).catch(err => console.log(err))
    }

    const triggerFileUpload = (e) => {
        e.preventDefault()

        console.log(imageUpload)

        imageUpload.current.click()
    }

    const handleImageUpload = (event) => {
        // const reader = new FileReader()
        // const canvas = document.createElement('canvas'),
        //     ctx = canvas.getContext('2d')
        //
        // const imageFile = event.target.files[0]
        //
        // reader.readAsDataURL(imageFile)
        //
        // reader.onload = function (e) {
        //     let image = new Image()
        //
        //     image.src = e.target.result
        //
        //     image.onload = function() {
        //         ctx.drawImage(image, 0, 0)
        //
        //         const imageData = ctx.getImageData(0, 0, image.height, image.width)
        //
        //         console.log(imageData)
        //
        //         const result = jsQR(imageData.data, imageData.width, imageData.height)
        //
        //         console.log(result)
        //     }
        // }

        const html5QrCode = new Html5Qrcode('reader')

        const imageFile = event.target.files[0];
        // Scan QR Code
        html5QrCode.scanFile(imageFile, true)
            .then(decodedText => {
                // success, use decodedText
                console.log(decodedText);
                setData('device_id', decodedText)
            })
            .catch(err => {
                // failure, handle it.
                console.log(`Error scanning file. Reason: ${err}`)
            });
    }

    const handleReset = () => reset('name','email','password','device_id')

    const handleSubmit = (e) => {
        e.preventDefault()

        post('/create-user', {
            preserveScroll: true,
            onSuccess: () => reset('name','email','password','device_id')
        })
    }

    return (
        <Layout>
            <div id="reader" style={{
                height: 600,
                width: 600,
                display: 'none'
            }} />

            <div className="row justify-content-center">
                <div className="col-md-6">
                    <div className="card">
                        <h5 className="card-header">
                            Create New User
                        </h5>
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
                                        <div className="input-group">
                                            <input className="form-control" value={data.device_id} placeholder="Device ID" name="device_id" type="text" onChange={handleOnChange}/>
                                            <button type="button" className="btn btn-outline-secondary" onClick={triggerFileUpload}>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" className="bi bi-qr-code-scan"
                                                     viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z"/>
                                                    <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z"/>
                                                    <path d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z"/>
                                                    <path
                                                        d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4 2v-1H8v1h2Z"/>
                                                    <path d="M12 9h2V8h-2v1Z"/>
                                                </svg>
                                            </button>
                                            <input className="d-none" ref={imageUpload} type="file" capture="environment" accept="image/*" onChange={handleImageUpload} />
                                        </div>
                                        {errors.device_id && <div className="text-danger">
                                            <small>{errors.device_id}</small></div>}
                                    </div>
                                </div>

                                <div className="form-group row">
                                    <div className="col-md-8 offset-md-4">
                                        <button type="submit" disabled={processing} className="btn btn-block btn-primary">
                                            {
                                                processing ? 'Processing...' : 'Submit'
                                            }
                                        </button>
                                        <button type="reset" disabled={processing} className="btn btn-block btn-danger ms-2">Reset</button>
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
