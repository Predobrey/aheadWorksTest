import React from 'react';
import Item from "./components/Item";

export default function Tickets(props) {
    return (
        <section className='tickets__allPost'>
            <ul>
                {props.array.map((arr, index) => {
                    return <Item arr={arr} key={index} index={index}/>
                })}
            </ul>
        </section>
    );
}
