import React, { Component } from 'react'
import './QrReader.css'
class QrReaderTVC extends Component {

    constructor(props) {
        super(props)
        var tr_id = new URL(window.location.href).searchParams.get("tr")
        this.state = {
            tr_id
        }
    }

    render() {
        var src = `${window.location.origin}/input-qr?tr_id=${this.state.tr_id}&nij=5`;
        return ( <div>
            <
            iframe style = {
                { position: 'relative' }
            }
            src = { src }
            title = "abc"
            frameBorder = "0"
            allow = "microphone"

            /
            >
        </div>

        )
    }
}
export default QrReaderTVC;