HashChain
=========

> WARNING: HashChain is intended for experimenting and learning, NOT for a production environment.

![Image of Yobi](http://www.primechaintech.com/assets/base/img/content/github/github_hashchain.png)

HashChain is a simple blockchain powered drag n drop solution for authenticating and verifying electronic records. It is built with php and can be readily deployed on [Multichain](https://github.com/MultiChain). The HashChain project is maintained by [Primechain Technologies Pvt. Ltd.](http://www.primechain.in).

System Requirements
-------------------

An instance of [YobiChain](https://github.com/Primechain/yobichain)

Installation
------------

HashChain is automatically installed during the [YobiChain](https://github.com/Primechain/yobichain) setup.

Using HashChain
---------------
1. Go to `http://<IP Address>/hashchain` and drag and drop any file (text, doc, pdf, video anything). 

2. The hash of the file will be immediately calculated in your browser. 

3. This hash will then be uploaded to your blockchain and stored. 

4. To verify, go to `http://<IP Address>/hashchain/verifier.php` and drag and drop a file. 

5. If the hash of that file exists in your blockchain, the file will show as verified. If not, it will show as not verified.


Live demo
---------
Links to the live demo can be found here - [https://github.com/Primechain/yobichain](https://github.com/Primechain/yobichain).


Contributors
-------------
A non-exhaustive list of contributors:
* Sripathi Srinivasan (sripathi@primechain.in) [Project Lead]
* Rohas Nagpal (rohas@primechain.in)
* Sudin Baraokar (HEAD.SBICIC@sbi.co.in)
* Shinam Arora (shinam@primechain.in)
