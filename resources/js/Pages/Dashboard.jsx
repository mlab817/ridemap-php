import React, { useState, useEffect } from 'react'
import { HorizontalGridLines, VerticalBarSeries, VerticalGridLines, XAxis, XYPlot, YAxis} from "react-vis";

const Dashboard = ({ stations }) => {
    const [data, setData] = useState([])

    useEffect(() => {
        const mappedData = stations.map(({ name, count }) => ({ x: name, y: count }))

        setData(mappedData)
    }, [stations])

    return (
        <div>
            <h1>Dashboard</h1>

            <div style={{
                display: 'flex',
                justifyContent: 'center',
                marginTop: 20,
            }}>
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
                            width={window.innerWidth * 0.60}>
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
    )
}

export default Dashboard
