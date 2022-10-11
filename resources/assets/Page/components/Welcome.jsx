import React, {useEffect, useState} from 'react';
import NET from "../../network";

export default function Welcome() {
    let [name, setName] = useState('');
    useEffect(() => {
        fetch(`${NET.API.TICKETS.GET}`, {
            method: 'GET',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
                'X-XSRF-TOKEN': getMeta('csrf-token'),
                'Authorization': `Bearer ${getCookie('token')}`,
            }
        })
            .then(response => response.json())
            .then(
                (result) => {
                    setName(result['login'])
                },
                (error) => {
                    console.log(error)
                }
            )
    }, [])

    function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));

        return matches ? decodeURIComponent(matches[1].slice(0, 100)) : undefined;
    }

    function getMeta(metaName) {
        const metas = document.getElementsByTagName('meta');

        for (let i = 0; i < metas.length; i++) {
            if (metas[i].getAttribute('name') === metaName) {
                return metas[i].getAttribute('content');
            }
        }

        return '';
    }

    return (
        <section className='tickets__welcome'>
            <h4>Welcome to your personal account {name}</h4>
            <div className="exit">
                <form action="/logout" method='GET'>
                    <button type="submit">Exit</button>
                </form>
            </div>
        </section>
    );
}
