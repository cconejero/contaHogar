/**
 * Copyright 2018 Google Inc. All Rights Reserved.
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *     http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// If the loader is already loaded, just stop.
if (!self.define) {
  let registry = {};

  // Used for `eval` and `importScripts` where we can't get script URL by other means.
  // In both cases, it's safe to use a global var because those functions are synchronous.
  let nextDefineUri;

  const singleRequire = (uri, parentUri) => {
    uri = new URL(uri + ".js", parentUri).href;
    return registry[uri] || (
      
        new Promise(resolve => {
          if ("document" in self) {
            const script = document.createElement("script");
            script.src = uri;
            script.onload = resolve;
            document.head.appendChild(script);
          } else {
            nextDefineUri = uri;
            importScripts(uri);
            resolve();
          }
        })
      
      .then(() => {
        let promise = registry[uri];
        if (!promise) {
          throw new Error(`Module ${uri} didn’t register its module`);
        }
        return promise;
      })
    );
  };

  self.define = (depsNames, factory) => {
    const uri = nextDefineUri || ("document" in self ? document.currentScript.src : "") || location.href;
    if (registry[uri]) {
      // Module is already loading or loaded.
      return;
    }
    let exports = {};
    const require = depUri => singleRequire(depUri, uri);
    const specialDeps = {
      module: { uri },
      exports,
      require
    };
    registry[uri] = Promise.all(depsNames.map(
      depName => specialDeps[depName] || require(depName)
    )).then(deps => {
      factory(...deps);
      return exports;
    });
  };
}
define(['./workbox-8b6cdeda'], (function (workbox) { 'use strict';

  self.addEventListener('message', event => {
    if (event.data && event.data.type === 'SKIP_WAITING') {
      self.skipWaiting();
    }
  });

  /**
   * The precacheAndRoute() method efficiently caches and responds to
   * requests for URLs in the manifest.
   * See https://goo.gl/S9QRab
   */
  workbox.precacheAndRoute([{
    "url": "/js/app.js",
    "revision": "3a16de665e88641e098df7b1d237122d"
  }, {
    "url": "/js/manifest.js",
    "revision": "823515a4471641ad511086b41dc62197"
  }, {
    "url": "/js/vendor.js",
    "revision": "c43fa8edbae0b4440b236c2b928d709e"
  }, {
    "url": "css/app.css",
    "revision": "704527470ef2213758d85fb10c5d39ac"
  }, {
    "url": "js/resources_js_Pages_Auth_Login_vue.js",
    "revision": "2ac08fa1bac42350ab5f1c56efff6ae5"
  }, {
    "url": "js/resources_js_Pages_CardSpends_Create_vue.js",
    "revision": "9606b069a5cd226368eddef7c7080343"
  }, {
    "url": "js/resources_js_Pages_Cards_Create_vue.js",
    "revision": "1c18ea0b0b538e3d6e8616108e6a6dd7"
  }, {
    "url": "js/resources_js_Pages_Cards_Index_vue.js",
    "revision": "462fd76f80ba3aef47be30fa241fead4"
  }, {
    "url": "js/resources_js_Pages_Cards_Show_vue.js",
    "revision": "95e23ea4f91eedb6307864916e19f733"
  }, {
    "url": "js/resources_js_Pages_Home_vue.js",
    "revision": "653c1dbd91e28e6a38c23ebb49dc487d"
  }, {
    "url": "js/resources_js_Pages_PWAPrompt_vue.js",
    "revision": "b8729507834b9df8484546517fb414c6"
  }, {
    "url": "js/resources_js_Pages_Settings_vue.js",
    "revision": "01e35f123d9959352c78404036dc1819"
  }, {
    "url": "js/resources_js_Pages_Users_Create_vue.js",
    "revision": "ac36f37775dfa565c4b504c307fdcafa"
  }, {
    "url": "js/resources_js_Pages_Users_Index_vue.js",
    "revision": "098a4723957a09d072676a2fb9b07310"
  }], {});

}));
