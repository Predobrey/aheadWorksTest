import React, {useEffect, useState} from 'react';
import Tickets from './Page/Tickets';
import NET from "./network";
import {useForm} from "react-hook-form";
import Welcome from "./Page/components/Welcome";

export default function App() {
    let [array, setArray] = useState([]);
    const {
        register,reset, formState: {
            errors,
        }, handleSubmit
    } = useForm();
    const onSubmit = data => {
        fetch(NET.API.TICKETS.POST, {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
                'X-XSRF-TOKEN': getMeta('csrf-token'),
                'Authorization': `Bearer ${getCookie('token')}`,
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(
                (result) => {
                    console.log(result);
                    setArray(result[0])
                },
                (error) => {
                    console.log(error)
                }
            )
        reset();
        getReqRes(data);
    };
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
                    setArray(result[0])
                    console.log(result);
                    document.cookie = `token=${result.token}`;
                },
                (error) => {
                    console.log(error)
                }
            )
    }, [])

    function getReqRes() {
        axios.post('https://reqres.in/api/register', {
                "email": "eve.holt@reqres.in",
                "password": "pistol"
            })
            .then(response => console.log(response.data));
    }

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
        <div className="tickets">
            <div className="container">
                <Welcome/>
                <section className="tickets__reactForm">
                    <form onSubmit={handleSubmit(onSubmit)} method='POST'>
                        <input placeholder="Subject" {...register('subject', {
                            required: "Поле обязательно для заполнения!",
                        })}/>
                        <input placeholder="Name" {...register('user_name', {
                            required: "Поле обязательно для заполнения!",
                        })}/>
                        <input placeholder="Email" {...register('user_email', {
                            required: "Поле обязательно для заполнения!",
                        })}/>
                        <button className='form__button' type="submit">Send</button>
                        <div>{errors?.login && <p>{errors?.login?.message}</p>}</div>
                    </form>
                </section>
                <Tickets array={array}/>
            </div>
        </div>
    );
}
