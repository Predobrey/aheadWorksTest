import React, {useEffect} from 'react';
import NET from "../../network";

export default function Item({arr, index}) {
    return (
        <li>#{index+1} <strong>Subject:</strong> {arr.subject}, <strong>Name:</strong> {arr.user_name}, <strong>Email:</strong> {arr.user_email}</li>
    );
}
