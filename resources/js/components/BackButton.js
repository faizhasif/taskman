import React from 'react'
import { useHistory } from 'react-router-dom'

const BackButton = () => {
    let history = useHistory()
    return (
        <button className="btn btn-secondary mx-2" onClick={ () => { history.goBack() } }>Go back</button>
    )
}

export default BackButton 