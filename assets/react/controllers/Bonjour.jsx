import React from "react";

export default function Bonjour(props){
    console.log('Received props:', props);
    return <div>Bonjour from {props.fullName}</div>;
}