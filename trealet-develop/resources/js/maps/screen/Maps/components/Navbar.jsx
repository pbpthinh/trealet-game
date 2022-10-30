import React, { Component,useState } from 'react'
import PropTypes from 'prop-types'
import { Button, Drawer } from 'antd';


export default function Navbar() {
    const [visible, setVisible] = useState(false);

    console.log('rerender');
    const showDrawer = () => {
        console.log('show');

        setVisible(true);
    };

    const onClose = () => {
        setVisible(false);
        console.log('closer');

    };
    return (
        <div>
            <>
                <Button type="primary" onClick={showDrawer}>
                    GPS
                </Button>
                <Button type="primary" onClick={showDrawer}>
                    Edit 
                </Button>
                <Button type="primary" onClick={showDrawer}>
                    Add
                </Button>
                <Drawer title="Basic Drawer" placement="right" onClose={onClose} visible={visible}>
                    <p>Some contents...</p>
                    <p>Some contents...</p>
                    <p>Some contents...</p>
                </Drawer>
            </>
        </div>
    )
}
