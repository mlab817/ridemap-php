import React, { useState, useEffect } from 'react'
import { HorizontalGridLines, VerticalBarSeries, VerticalGridLines, XAxis, XYPlot, YAxis} from "react-vis";
import {Link, usePage} from "@inertiajs/inertia-react";
import Layout from "../components/Layout";

const Dashboard = ({ stations, type }) => {
    const [data, setData] = useState([])

    useEffect(() => {
        const mappedData = stations.map(({ name, count }) => ({ x: name, y: count }))

        setData(mappedData)
    }, [stations])

    return (
        <Layout>

            <div className="card">
                <div className="card-header">
                    Dashboard
                </div>

                <div className="card-body">

                    <ul className="nav nav-pills nav-fill justify-content-center mt-3 mb-3">
                        <li className="nav-item">
                            <Link
                                href="/"
                                data={{ by: 'count' }}
                                className={`nav-link ${type === 'count' && 'active'}`}>Count</Link>
                        </li>
                        <li className="nav-item">
                            <Link href="/" data={{ by: 'qr' }} className={`nav-link ${type === 'qr' && 'active'}`}>QR</Link>
                        </li>
                        <li className="nav-item">
                            <Link href="/" data={{ by: 'kiosk' }} className={`nav-link ${type === 'kiosk' && 'active'}`}>Kiosk</Link>
                        </li>
                        <li className="nav-item">
                            <Link href="/" data={{ by: 'faces' }} className={`nav-link ${type === 'faces' && 'active'}`}>Faces</Link>
                        </li>
                    </ul>

                    <div className="row justify-content-center">
                        {
                            data.length && (
                                <XYPlot
                                    animation
                                    xType="ordinal"
                                    margin={{
                                        left: 50,
                                        bottom: 120
                                    }}
                                    xDistance={200}
                                    height={window.innerHeight * 0.85}
                                    width={window.innerWidth * .95}>
                                    <VerticalGridLines />
                                    <HorizontalGridLines />
                                    <XAxis style={{
                                        fontSize: `0.9em`
                                    }} tickLabelAngle={-90} />
                                    <YAxis style={{
                                        fontSize: `0.9em`
                                    }} tickFormat={d => ((d / 1000) + 'K')} />
                                    <VerticalBarSeries data={data} />
                                </XYPlot>
                            )
                        }
                    </div>
                </div>
            </div>
        </Layout>
    )
}

export default Dashboard
