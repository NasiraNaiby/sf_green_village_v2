import { registerReactControllerComponents } from '@symfony/ux-react';
import './bootstrap.js';
import './styles/app.css';
import React from 'react';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

// ✅ Only this line is needed:
registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));
