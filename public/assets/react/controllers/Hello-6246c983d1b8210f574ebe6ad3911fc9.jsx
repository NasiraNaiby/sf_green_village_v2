// assets/react/controllers/Hello.jsx
import React from 'react';

export default function Hello(props) {
    console.log('Received props:', props);
    return <div>Hello from {props.fullName}</div>;
}
